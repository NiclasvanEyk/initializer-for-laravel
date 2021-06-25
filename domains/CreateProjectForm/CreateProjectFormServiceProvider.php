<?php

namespace Domains\CreateProjectForm;

use Domains\CreateProjectForm\Components\StarterKit\Selector;
use Domains\CreateProjectForm\Http\Routes;
use Domains\CreateProjectForm\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CreateProjectFormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('web')->group(function () {
            Routes::register();
        });

        $this->loadStarterKitComponents();
    }

    private function loadStarterKitComponents()
    {
        $this->loadViewsFrom(
            __DIR__ . '/resources/views/starter-kit',
            'starter-kit'
        );

        Blade::componentNamespace(
            Str::namespace(Selector::class),
            'starter-kit'
        );
    }
}
