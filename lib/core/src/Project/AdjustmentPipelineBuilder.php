<?php

namespace InitializerForLaravel\Core\Project;

use Illuminate\Contracts\Container\Container;
use InitializerForLaravel\Core\Contracts\ProjectAdjustment;
use function array_map;

readonly final class AdjustmentPipelineBuilder
{
    public function __construct(Container $container)
    {
    }

    /**
     * @param array<int,class-string<ProjectAdjustment>> $adjustments
     */
    public function apply(array $adjustments): AdjustmentPipeline {
        return new AdjustmentPipeline($this->resolve($adjustments));
    }

    /**
     * @param array<int,class-string<ProjectAdjustment>> $adjustmentClasses
     * @return array<int,ProjectAdjustment>
     */
    private function resolve(array $adjustmentClasses): array
    {
        return array_map(
            fn(string $class) => resolve($class),
            $adjustmentClasses
        );
    }
}
