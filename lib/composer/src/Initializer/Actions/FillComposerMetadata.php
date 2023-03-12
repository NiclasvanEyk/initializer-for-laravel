<?php

namespace InitializerForLaravel\Composer\Initializer\Actions;

use App\Initializer\Configuration\Option;
use App\Initializer\ProjectAdjustment;
use InitializerForLaravel\Composer\ComposerJsonFile;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Composer\Initializer\ComposerProject;
use InitializerForLaravel\Core\Project;

readonly final class FillComposerMetadata implements ProjectAdjustment
{
    public function __construct(private ComposerPackageMetadata $metadata)
    {
    }

    /**
     * @param array<string,Option> $options
     */
    public function apply(Project $project, array $options): void
    {
        ComposerProject::from($project)->editComposerJson(
            function (ComposerJsonFile $composerJson) {
                $composerJson
                    ->setFullProjectName($this->metadata->fullName())
                    ->setDescription($this->metadata->description)
                    ->setPhpVersion($this->metadata->phpVersion);
           }
       );
    }
}
