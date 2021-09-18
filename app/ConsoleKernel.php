<?php

namespace App;

use Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;
use Laravel\Installer\Console\NewCommand;

class ConsoleKernel extends Kernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(UpdateTemplateCommand::class)->hourly();
    }
}
