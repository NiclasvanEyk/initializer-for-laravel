<?php

namespace InitializerForLaravel\Composer\Initializer;

use InitializerForLaravel\Composer\ComposerJsonFile;
use InitializerForLaravel\Core\Project;

readonly final class ComposerProject
{
    public function __construct(private Project $project)
    {
    }

    public static function from(Project $project): self
    {
        return new self($project);
    }

    public function editComposerJson(callable $edit): void
    {
        $composerJson = ComposerJsonFile::fromString(
            $this->project->archive->getEntryContents('composer.json')
        );

        $edit($composerJson);
        $this->project->archive->addFromString(
            'composer.json',
            $composerJson->prettyContents(),
        );
    }
}
