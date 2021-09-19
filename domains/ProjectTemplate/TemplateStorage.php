<?php

namespace Domains\ProjectTemplate;

use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Adapter\Local;
use PhpZip\ZipFile;

/**
 * Physical storage layer for the template on the local filesystem.
 */
class TemplateStorage
{
    const TEMPLATE_FILE_NAME = 'template.zip';
    const VERSION_FILE_NAME = 'version';
    const CURRENT_SYMLINK_NAME = 'current';

    private Local $filesystem;

    public function __construct(private LaravelDownloader $laravelDownloader) {
        $this->filesystem = new Local(storage_path('app/laravel-releases'));
    }

    public function exists(): bool
    {
        return is_file($this->pathToCurrentVersion());
    }

    public function currentArchive(): ZipFile
    {
        return (new ZipFile())->openFile($this->pathToCurrentArchive());
    }

    public function currentVersion(): string
    {
        if (!$this->exists()) {
            return 'unknown';
        }

        $currentVersion = file_get_contents($this->pathToCurrentVersion());

        if ($currentVersion === false) {
            return 'unknown';
        }

        return $currentVersion;
    }

    public function updateCurrentRelease(): void
    {
        $release = $this->laravelDownloader->downloadLatest();

        $this->store($release);
        $this->setCurrentRelease($release);
    }

    private function setCurrentRelease(DownloadedLaravelRelease $release): void
    {
        File::delete($this->pathToCurrent());
        File::link($this->pathTo($release), $this->pathToCurrent());
        Log::info("Current template version was set to {$release->package->version}!");
    }

    private function pathTo(DownloadedLaravelRelease $release): string
    {
        return $this->filesystem->applyPathPrefix($release->package->version);
    }

    private function pathToCurrent(): string
    {
        return $this->filesystem->applyPathPrefix(self::CURRENT_SYMLINK_NAME);
    }

    private function pathToCurrentArchive(): string
    {
        return $this->filesystem->applyPathPrefix(self::TEMPLATE_FILE_NAME);
    }

    private function pathToCurrentVersion(): string
    {
        return Path::join($this->pathToCurrent(), self::VERSION_FILE_NAME);
    }

    public function store(DownloadedLaravelRelease $release): void {
        File::deleteDirectory($this->pathTo($release));
        File::ensureDirectoryExists($this->pathTo($release));
        $releaseFolder = new Local($this->pathTo($release));

        $release->archive->saveAsFile(
            $releaseFolder->applyPathPrefix(self::TEMPLATE_FILE_NAME),
        );
        File::put(
            $releaseFolder->applyPathPrefix(self::VERSION_FILE_NAME),
            $release->package->version,
        );
    }
}
