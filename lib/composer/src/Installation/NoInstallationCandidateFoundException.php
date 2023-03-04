<?php

namespace InitializerForLaravel\Composer\Installation;

use Exception;
use InitializerForLaravel\Composer\ComposerDependency;

class NoInstallationCandidateFoundException extends Exception
{
    public function __construct(public ComposerDependency $package)
    {
        parent::__construct("Could find an installation candidate for package '{$package->packageId()}'!");
    }
}
