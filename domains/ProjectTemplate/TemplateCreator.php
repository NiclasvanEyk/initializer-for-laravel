<?php

namespace Domains\ProjectTemplate;

use Domains\Composer\ComposerJsonFile;
use League\Flysystem\Adapter\Local;
use PhpZip\ZipFile;

class TemplateCreator
{
    const TEMPLATE_FILE_NAME = 'template.zip';
    const COMPOSER_FILE_NAME = 'composer.json';

    public function __construct(
        private string $source,
        private Local $target,
        private ComposerJsonFile $composerJson,
    ){}

    public function write()
    {
        (new ZipFile())
            ->addDirRecursive($this->source)
            ->saveAsFile(
                $this->target->applyPathPrefix(self::TEMPLATE_FILE_NAME)
            );

        $this->composerJson->flush(
            $this->target->applyPathPrefix(self::COMPOSER_FILE_NAME)
        );
    }
}
