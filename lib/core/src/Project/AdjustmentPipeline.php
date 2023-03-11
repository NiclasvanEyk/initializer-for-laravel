<?php

namespace InitializerForLaravel\Core\Project;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectAdjustment;
use InitializerForLaravel\Core\Project;

readonly final class AdjustmentPipeline
{
    /**
     * @param array<int,ProjectAdjustment> $adjustments
     */
    public function __construct(private array $adjustments)
    {
    }

    public function to(Project $project, Configuration $configuration): Project
    {
        foreach ($this->adjustments as $adjustment) {
            $adjustment->apply($project, $configuration);
        }

        return $project;
    }
}
