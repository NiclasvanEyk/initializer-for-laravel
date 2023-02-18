<?php

namespace InitializerForLaravel\Composer;

use Exception;

class NoInstallationCandidateFoundException extends Exception
{
    public function __construct(public ComposerDependency $package)
    {
        parent::__construct("Could find an installation candidate for package '{$package->packageId()}'!");
    }
}
