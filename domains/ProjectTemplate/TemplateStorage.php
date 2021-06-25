<?php

namespace Domains\ProjectTemplate;

use Domains\Composer\ComposerJsonFile;
use Illuminate\Support\Facades\File;
use League\Flysystem\Adapter\Local;

/**
 * Physical storage layer for the template on the local filesystem.
 */
class TemplateStorage
{
    private Local $filesystem;

    public function __construct() {
        $this->filesystem = new Local(storage_path('app'));
    }

    public function exists(): bool
    {
        return $this->filesystem->has(TemplateCreator::COMPOSER_FILE_NAME)
            && $this->filesystem->has(TemplateCreator::TEMPLATE_FILE_NAME);
    }

    public function path(): string
    {
        return (string) $this->filesystem->getPathPrefix();
    }

    public function store(
        string $path,
        ComposerJsonFile $composerJson,
    ) {
        File::deleteDirectory($this->path());
        File::ensureDirectoryExists($this->path());

        (new TemplateCreator($path, $this->filesystem, $composerJson))->write();
    }
}
