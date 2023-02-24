<?php

namespace App\Initializer;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use PhpZip\ZipFile;

class LaravelProjectGenerator implements ProjectGenerator
{
    public function generate(Configuration $configuration): ZipFile
    {

    }

    private function sailServices()
    {
        $sections = config('initializer-for-laravel.sections');
    }
}
