<?php

namespace Domains\CreateProjectForm\Http;

use Domains\CreateProjectForm\Http\Controllers\CreateProjectController;
use Domains\CreateProjectForm\Http\Controllers\PermalinkController;
use Domains\CreateProjectForm\Http\Controllers\ShowFormController;
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
        Route::name('create-project')
            ->post('create-project', CreateProjectController::class);
    }
}
