<?php

namespace App\Dependencies\Laravel;

class Envoy extends FirstPartyPackage
{
    function description(): string
    {
        return 'A tool for executing common tasks you run on your remote '
            . 'servers for deployment, Artisan commands, and more.';
    }
}
