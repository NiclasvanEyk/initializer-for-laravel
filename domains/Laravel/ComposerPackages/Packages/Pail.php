<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class Pail extends FirstPartyPackage
{
    const REPOSITORY_KEY = 'pail';

    public function description(): string
    {
        return "Dive into your Laravel application's log files directly from the console.";
    }
}
