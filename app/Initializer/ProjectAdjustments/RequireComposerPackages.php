<?php

namespace App\Initializer\ProjectAdjustments;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectAdjustment;
use InitializerForLaravel\Core\Project\Project;

readonly final class RequireComposerPackages implements ProjectAdjustment
{
    public function apply(Project $project, Configuration $configuration): void
    {
        // TODO: Implement apply() method.
    }
}
