<?php

namespace Domains\Schedule;

use Domains\Schedule\Http\Controllers\ScheduleRunController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        RateLimiter::for('schedule-endpoint', fn () => Limit::perHour(10));

        Route::middleware('throttle:schedule-endpoint')
            ->get('/schedule-run', ScheduleRunController::class);
    }
}
