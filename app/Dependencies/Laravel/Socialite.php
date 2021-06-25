<?php

namespace App\Dependencies\Laravel;

class Socialite extends FirstPartyPackage
{
    function description(): string
    {
        return 'Integrations with popular OAuth providers, so your users can '
            . 'login with Facebook, Twitter, Google and more.';
    }
}
