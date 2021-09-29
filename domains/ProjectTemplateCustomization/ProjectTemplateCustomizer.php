<?php

namespace Domains\ProjectTemplateCustomization;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\ArchiveManipulation\ArchiveManipulatorResolver;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\ProjectTemplate\TemplateStorage;
use PhpZip\ZipFile;

/**
 * Builds the final archive from the laravel/laravel template.
 */
class ProjectTemplateCustomizer
{
    public function __construct(
        private TemplateStorage $template,
        private ArchiveManipulatorResolver $archiveManipulatorResolver,
    ) {
    }

    public function build(CreateProjectForm $form): ZipFile
    {
        $archive = $this->template->currentArchive();
        $manipulators = $this->archiveManipulatorResolver->resolve();

        $manipulators->each(
            function (ArchiveManipulator $manipulator) use ($archive, $form) {
                $manipulator->manipulate($archive, $form);
            },
        );

        return $archive;
    }
}
