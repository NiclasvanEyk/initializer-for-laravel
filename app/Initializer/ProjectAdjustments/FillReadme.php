<?php

namespace App\Initializer\ProjectAdjustments;

use InitializerForLaravel\Core\Configuration\Configuration;
use App\Initializer\ProjectAdjustment;
use InitializerForLaravel\Core\Project;

readonly final class FillReadme implements ProjectAdjustment
{
    public function apply(Project $project, Configuration $configuration): void
    {
        if ($configuration->has('mailpit')) {
            $project->readme->links->add('Mailpit', 'http://localhost:5432');
        }
    }
}
