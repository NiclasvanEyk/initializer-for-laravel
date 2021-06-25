<?php

namespace Domains\Laravel\StarterKit;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;

class Laravel extends StarterKit
{
    public function __construct()
    {
        parent::__construct(StarterKit::LARAVEL);
    }

    function composerPackage(): ?ComposerDependency
    {
        return null;
    }
}
