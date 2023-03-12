<?php

namespace App\Initializer;

use InitializerForLaravel\Core\Configuration\Configuration;
use App\Initializer\ProjectAdjustment;
use InitializerForLaravel\Core\Project;

readonly final class AdjustmentPipeline
{
    /**
     * @param array<int,ProjectAdjustment> $adjustments
     */
    public function __construct(private array $adjustments)
    {
    }

    public function to(Project $project, array $options): Project
    {
        foreach ($this->adjustments as $adjustment) {
            $adjustment->apply($project, $options);
        }

        return $project;
    }
}
