<?php

namespace App;

use App\Http\IndexController;
use App\Initializer\TemplateStorage\LaravelProjectTemplateDownloader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use InitializerForLaravel\Core\Contracts\TemplateDownloader;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        TemplateDownloader::class => LaravelProjectTemplateDownloader::class,
    ];

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Route::get('/new', IndexController::class);
    }
}
