<?php

namespace App\Dependencies\Laravel;

class Sanctum extends FirstPartyPackage
{
    function description(): string
    {
        return 'A featherweight authentication system for SPAs '
            . '(single page applications), mobile applications, and simple, '
            . 'token based APIs.';
    }
}
