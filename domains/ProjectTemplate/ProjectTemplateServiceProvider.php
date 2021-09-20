<?php

namespace Domains\ProjectTemplate;

use Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand;
use Domains\ProjectTemplate\Http\Controllers\ScheduleRunController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Installer\Console\NewCommand;

class ProjectTemplateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            UpdateTemplateCommand::class,
            NewCommand::class,
        ]);

        $this->setupScheduleHack();
    }

    private function setupScheduleHack(): void
    {
        RateLimiter::for('schedule-endpoint', fn () => Limit::perHour(10));

        Route::middleware('throttle:schedule-endpoint')
            ->get('/schedule-run', ScheduleRunController::class);
    }
}
