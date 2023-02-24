<?php

namespace InitializerForLaravel\Core\Storage;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use PhpZip\ZipFile;

class LocalTemplateStorage implements TemplateStorage
{
    const ARCHIVE_FILE_NAME = 'template.zip';
    const VERSION_FILE_NAME = 'version';
    const CURRENT_SYMLINK_NAME = 'current';

    public function __construct(public readonly string $base)
    {
    }

    public function get(): ?ZipFile
    {
        $path = $this->pathToCurrent(self::ARCHIVE_FILE_NAME);
        if (! File::exists($path)) {
            return null;
        }

        return (new ZipFile())->openFile($path);
    }

    public function version(): ?string
    {
        $path = $this->pathToCurrent(self::VERSION_FILE_NAME);
        $currentVersion = File::get($path);
        if (empty($currentVersion)) {
            return null;
        }

        return $currentVersion;
    }

    public function update(string $version, ZipFile $archive): void
    {
        $this->store($version, $archive);
        $this->setCurrentRelease($version);
    }

    private function prefix(string ...$paths): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->base, ...$paths]);
    }

    private function pathToCurrent(string $path = ''): string
    {
        if ($path === '') {
            return self::CURRENT_SYMLINK_NAME;
        }

        return $this->prefix(self::CURRENT_SYMLINK_NAME, $path);
    }

    private function setCurrentRelease(string $version): void
    {
        File::deleteDirectory($this->pathToCurrent());

        File::copyDirectory(
            $this->prefix($version),
            $this->prefix($this->pathToCurrent())
        );
        Log::info("Current template version was set to $version!");
    }

    private function store(string $version, ZipFile $archive): void
    {
        File::deleteDirectory($version);
        File::makeDirectory($version);

        $this->createVersionFile($version);

        $archivePath = $this->prefix($version, self::ARCHIVE_FILE_NAME);
        $archive->saveAsFile($archivePath);
    }

    private function createVersionFile(string $version): void
    {
        $versionPath = $this->prefix($version, self::VERSION_FILE_NAME);
        File::put($versionPath, $version);
    }
}
