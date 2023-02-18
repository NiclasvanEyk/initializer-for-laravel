<?php

namespace Domains\Laravel\StarterKit;

use InitializerForLaravel\Composer\ComposerDependency;

class Laravel extends StarterKit
{
    public function __construct()
    {
        parent::__construct(StarterKit::LARAVEL);
    }

    public function composerPackage(): ?ComposerDependency
    {
        return null;
    }
}
