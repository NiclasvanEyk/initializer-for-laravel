<?php

namespace Domains\Schedule;

use Domains\Schedule\Http\Controllers\ScheduleRunController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for('schedule-endpoint', fn () => Limit::perMinute(1));

        Route::middleware('throttle:schedule-endpoint')
            ->get('/schedule-run', ScheduleRunController::class)
            ->name('schedule-run');
    }
}
