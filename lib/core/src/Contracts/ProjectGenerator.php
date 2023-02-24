<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Core\Configuration\Configuration;
use PhpZip\ZipFile;

interface ProjectGenerator
{
    public function generate(Configuration $configuration): ZipFile;
}
