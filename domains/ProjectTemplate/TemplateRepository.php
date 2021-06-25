<?php

namespace Domains\ProjectTemplate;

use Domains\Composer\ComposerJsonFile;
use Domains\ProjectTemplate\Console\Commands\DownloadCommand;
use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\Artisan;
use PhpZip\ZipFile;

/**
 * Abstracted class that manages access to the template zip.
 */
class TemplateRepository
{
    public function __construct(private TemplateStorage $storage) { }

    public function exists(): bool
    {
        return $this->storage->exists();
    }

    public function ensureExists(): void
    {
        if ($this->exists()) return;

        Artisan::call(DownloadCommand::class);
    }

    public function archive(): ZipFile
    {
        return (new ZipFile())->openFile(Path::join(
            $this->storage->path(),
            TemplateCreator::TEMPLATE_FILE_NAME,
        ));
    }

    public function composerJson(): ComposerJsonFile
    {
        return ComposerJsonFile::open(
            Path::join(
                $this->storage->path(),
                TemplateCreator::COMPOSER_FILE_NAME,
            )
        );
    }
}
