<?php

namespace App\Dependencies\Laravel;

class Telescope extends FirstPartyPackage
{
    function description(): string
    {
        return 'A beautiful dashboard that provides insight into the requests'
            . 'coming into your application, exceptions, log entries,'
            . 'database queries, queued jobs, mail, notifications,'
            . 'cache operations, scheduled tasks, variable dumps, and more.';
    }
}
