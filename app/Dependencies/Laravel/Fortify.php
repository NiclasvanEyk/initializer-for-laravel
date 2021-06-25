<?php

namespace App\Dependencies\Laravel;

class Fortify extends FirstPartyPackage
{
    function description(): string
    {
        return 'A backend implementation for Laravel\'s authentication '
             . 'features. Very useful if you want to build your own custom '
             . 'user interface for authentication, without reimplementing '
             . 'all the backend functionality.';
    }
}
