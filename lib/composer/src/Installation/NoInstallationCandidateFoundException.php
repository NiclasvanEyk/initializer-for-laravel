<?php

namespace InitializerForLaravel\Composer\Installation;

use Exception;
use InitializerForLaravel\Composer\ComposerDependency;

class NoInstallationCandidateFoundException extends Exception
{
    public function __construct(public InstallationInstructions $install)
    {
        parent::__construct("Could find an installation candidate for package '$install->package'!");
    }
}
