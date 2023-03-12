<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\Configuration\Option;
use App\Initializer\Configuration\Sail;
use App\Initializer\ProjectAdjustment;
use Domains\PostDownload\Tasks\SetupSail;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Project;

readonly final class AddEnvironmentPreparationScript implements ProjectAdjustment
{
    public function __construct(private ComposerPackageMetadata $metadata)
    {
    }

    /** @param array<string,Option> $options */
    public function apply(Project $project, array $options): void
    {
        $sailServiceIds = collect($options)
            ->flatMap(fn (Option $option) => $option->dependencies)
            ->filter(function (Dependency $dependency) {
                return $dependency->packageManager === Sail::PACKAGE_MANAGER;
            })
            ->map(fn (Dependency $sailService) => $sailService->id)
            ->all();

        $project->prepareEnvironmentScript->tasks[] = new SetupSail(
            $sailServiceIds,
            $this->metadata->phpVersion
        );
    }
}
