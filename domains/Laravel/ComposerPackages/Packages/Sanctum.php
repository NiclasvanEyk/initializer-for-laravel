<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class Sanctum extends FirstPartyPackage
{
    const REPOSITORY_KEY = 'sanctum';

    function description(): string
    {
        return 'A featherweight authentication system for SPAs '
            . '(single page applications), mobile applications, and simple, '
            . 'token based APIs. <b>Always included.</b>';
    }
}
