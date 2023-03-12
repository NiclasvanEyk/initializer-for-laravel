<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\ProjectAdjustment;
use Illuminate\Support\Facades\Log;
use InitializerForLaravel\Core\Project;

readonly final class SetDotEnvExampleParameters implements ProjectAdjustment
{
    public function apply(Project $project, array $options): void
    {
        Log::notice("Skipping SetDotEnvExampleParameters step...");
    }
}
