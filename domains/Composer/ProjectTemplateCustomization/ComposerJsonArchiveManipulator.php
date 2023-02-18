<?php

namespace Domains\Composer\ProjectTemplateCustomization;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\CreateProjectForm\CreateProjectForm;
use InitializerForLaravel\Composer\ComposerJsonFile;
use PhpZip\ZipFile;

class ComposerJsonArchiveManipulator implements ArchiveManipulator
{
    public function __construct(private ComposerJsonGenerator $generator)
    {
    }

    public function manipulate(ZipFile $archive, CreateProjectForm $form): void
    {
        $defaultComposerJsonContents = $archive->getEntryContents(
            'composer.json',
        );
        $defaultComposerJson = ComposerJsonFile::fromString(
            $defaultComposerJsonContents,
        );

        $customizedComposerJsonContents = $this->generator->render(
            $form,
            $defaultComposerJson,
        );
        $archive->addFromString(
            'composer.json',
            $customizedComposerJsonContents,
        );
    }
}
