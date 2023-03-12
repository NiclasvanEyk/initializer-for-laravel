<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\Configuration\Option;
use App\Initializer\ProjectAdjustment;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use InitializerForLaravel\Core\Project;
use function collect;

readonly final class AddPackageInstallationSteps implements ProjectAdjustment
{
    public function apply(Project $project, array $options): void
    {
        $tasks = collect($options)
            ->filter(fn(Option $o) => !empty($o->setup))
            ->map(fn(Option $o) => new ClosurePostInstallTaskGroup(
                "Setup $o->name",
                fn() => $o->setup)
            )
            ->all();

        foreach ($tasks as $group) {
            $project->scripts->setupProject->tasks[] = $group;
        }
    }
}
