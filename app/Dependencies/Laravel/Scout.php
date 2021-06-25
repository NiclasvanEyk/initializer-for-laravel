<?php

namespace App\Dependencies\Laravel;

class Scout extends FirstPartyPackage
{
    function description(): string
    {
        return 'A simple, driver based solution for adding full-text search to '
            . 'your Eloquent models.';
    }
}
