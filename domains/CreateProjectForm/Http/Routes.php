<?php

namespace Domains\CreateProjectForm\Http;

use Domains\CreateProjectForm\Http\Controllers\CreateProjectController;
use Domains\CreateProjectForm\Http\Controllers\PermalinkController;
use Domains\CreateProjectForm\Http\Controllers\ShowFormController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class Routes
{
    public static function register()
    {
        Route::name('root')->get('/', ShowFormController::class);
        Route::name('about')->get('about', function () {
            return view('about');
        });

        Route::name('permalink')
            ->post('permalink', PermalinkController::class);

        RateLimiter::for('create-project', function (Request $request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        Route::name('create-project')
            ->middleware('throttle:create-project')
            ->post('create-project', CreateProjectController::class);
    }
}
