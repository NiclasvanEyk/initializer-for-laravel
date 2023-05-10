<?php

namespace Domains\Schedule\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

use function abort_if;
use function response;

/**
 * This is a workaround, as I did not find an easiy and cheap way to
 * run cron jobs.
 *
 * Instead, we (mis-)use the health-check, to trigger the schedule:run command.
 *
 * @codeCoverageIgnore
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
