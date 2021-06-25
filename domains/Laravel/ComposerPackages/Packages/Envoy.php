<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class Envoy extends FirstPartyPackage
{
    const REPOSITORY_KEY = 'envoy';

    function description(): string
    {
        return 'A tool for executing common tasks you run on your remote '
            . 'servers for deployment, Artisan commands, and more.';
    }

    public function isDevDependency(): bool
    {
        return true;
    }
}
