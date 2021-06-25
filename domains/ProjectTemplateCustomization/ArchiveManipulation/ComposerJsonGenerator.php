<?php

namespace Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\Composer\ComposerJsonFile;
use Domains\CreateProjectForm\CreateProjectForm;

class ComposerJsonGenerator
{
    public function render(
        CreateProjectForm $form,
        ComposerJsonFile $composerJson,
    ): string {
        return $composerJson
            ->setPhpVersion($form->metadata->phpVersion)
            ->setFullProjectName($form->metadata->fullName())
            ->setDescription($form->metadata->description)
            ->prettyContents();
    }
}
