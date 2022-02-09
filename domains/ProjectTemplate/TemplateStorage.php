<?php

namespace Domains\ProjectTemplate;

use Domains\Support\FileSystem\Path;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use PhpZip\ZipFile;

/**
 * Physical storage layer for the template on the local filesystem.
 */
class TemplateStorage
{
    const ARCHIVE_FILE_NAME = 'template.zip';
    const VERSION_FILE_NAME = 'version';
    const CURRENT_SYMLINK_NAME = 'current';

    /** @codeCoverageIgnore */
    public function __construct(
        private FilesystemAdapter $filesystem,
        public string $pathPrefix,
    ) {
    }

    public function exists(): bool
    {
        return $this->currentVersion() !== 'unknown';
    }

    public function currentArchive(): ZipFile
    {
        $path = $this->current(self::ARCHIVE_FILE_NAME);
        $currentArchive = $this->filesystem->readStream($path) ?? throw new Exception("Current archive not available at '$path'!");

        return (new ZipFile())->openFromStream($currentArchive);
    }

    /** @codeCoverageIgnore */
    private function current(string $path = ''): string
    {
        if ($path === '') {
            return self::CURRENT_SYMLINK_NAME;
        }

        return Path::join(self::CURRENT_SYMLINK_NAME, $path);
    }

    public function currentVersion(): string
    {
        $currentVersion = false;

        try {
            $currentVersion = $this->filesystem->get(
                $this->current(self::VERSION_FILE_NAME)
            );
        } catch (FileNotFoundException) {
        }

        if (! is_string($currentVersion)) {
            return 'unknown';
        }

        return $currentVersion;
    }

    public function updateCurrentRelease(DownloadedLaravelRelease $release): void
    {
        $this->store($release);
        $this->setCurrentRelease($release);
    }

    /** @codeCoverageIgnore */
    private function setCurrentRelease(DownloadedLaravelRelease $release): void
    {
        $version = $release->package->version;
        $this->filesystem->delete($this->current());

        File::copyDirectory(
            $this->prefix($version),
            $this->prefix($this->current())
        );
        Log::info("Current template version was set to $version!");
    }

    private function prefix(string $path): string
    {
        return Path::join($this->pathPrefix, $path);
    }

    /** @codeCoverageIgnore */
    private function store(DownloadedLaravelRelease $release): void
    {
        $version = $release->package->version;

        $this->filesystem->deleteDirectory($version);
        $this->filesystem->makeDirectory($version);

        $archivePath = Path::join($version, self::ARCHIVE_FILE_NAME);
        $versionPath = Path::join($version, self::VERSION_FILE_NAME);

        $release->archive->saveAsFile($this->prefix($archivePath));

        $this->filesystem->put($versionPath, $version);
    }
}
