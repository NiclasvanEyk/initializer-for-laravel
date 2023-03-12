<?php

namespace App\Initializer;

use App\Initializer\Configuration\Option;
use InitializerForLaravel\Core\Project;

interface ProjectAdjustment
{
    /**
     * @param array<string,Option> $options
     */
    public function apply(Project $project, array $options): void;
}
