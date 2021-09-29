<?php

namespace Domains\Readme;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\CreateProjectForm\CreateProjectForm;
use PhpZip\ZipFile;

class ReadmeArchiveManipulator implements ArchiveManipulator
{
    public function __construct(private ReadmeGenerator $generator)
    {
    }

    public function manipulate(ZipFile $archive, CreateProjectForm $form): void
    {
        $archive->addFromString('README.md', $this->generator->render($form));
    }
}
