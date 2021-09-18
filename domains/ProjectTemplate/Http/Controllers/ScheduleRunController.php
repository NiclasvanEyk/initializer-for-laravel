<?php

namespace Domains\ProjectTemplate\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

/**
 * This is a workaround, as DigitalOcean currently does not (easily and cheap)
 * support cron jobs.
 *
 * Instead, we (mis-)use the health-check, to trigger the schedule:run command.
 */
class ScheduleRunController
{
    public function __invoke(): Response
    {
        $exitCode = Artisan::call('schedule:run');

        abort_if($exitCode !== 0, 500);

        return response(null, 200);
    }
}
