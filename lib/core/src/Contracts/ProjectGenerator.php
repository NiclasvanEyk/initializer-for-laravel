<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Project;

interface ProjectGenerator
{
    public function generate(Configuration $configuration): Project;
}
