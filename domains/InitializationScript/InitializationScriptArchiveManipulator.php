<?php

namespace Domains\InitializationScript;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\CreateProjectForm\CreateProjectForm;
use PhpZip\ZipFile;

class InitializationScriptArchiveManipulator implements ArchiveManipulator
{
    public function __construct(private InitializationScriptGenerator $generator)
    {
    }

    public function manipulate(ZipFile $archive, CreateProjectForm $form): void
    {
        $script = $this->generator->scriptName();
        $archive->addFromString($script, $this->generator->render($form));

        // Make sure the script is executable
        $archive->getEntry($script)->setUnixMode(0100754);
    }
}
