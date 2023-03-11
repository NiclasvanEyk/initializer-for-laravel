<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Project;

interface ProjectAdjustment
{
    public function apply(Project $project, Configuration $configuration): void;
}
