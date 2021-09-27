<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class Socialite extends FirstPartyPackage
{
    const REPOSITORY_KEY = 'socialite';

    public function description(): string
    {
        return 'Integrations with popular OAuth providers, so your users can '
            .'login via Facebook, Twitter, Google and more.';
    }
}
