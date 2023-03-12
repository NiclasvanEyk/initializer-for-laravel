<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\Configuration\Option;
use App\Initializer\Configuration\Sail;
use App\Initializer\ProjectAdjustment;
use Domains\PostDownload\Tasks\SetupSail;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Core\Project;

readonly final class AddSailServices implements ProjectAdjustment
{
    public function __construct(private ComposerPackageMetadata $metadata)
    {
    }

    /** @param array<string,Option> $options */
    public function apply(Project $project, array $options): void
    {
        $sailServices = [];
        foreach ($options as $option) {
            foreach ($option->dependencies as $dependency) {
                if ($dependency->packageManager === Sail::PACKAGE_MANAGER) {
                    $sailServices[] = $dependency->id;
                }
            }
        }

        $project->prepareEnvironmentScript->tasks[] = new SetupSail(
            $sailServices,
            $this->metadata->phpVersion
        );
    }
}
