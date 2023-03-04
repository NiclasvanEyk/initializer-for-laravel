<?php

namespace App;

use App\Http\IndexController;
use App\Initializer\TemplateStorage\LaravelProjectTemplateRetriever;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use InitializerForLaravel\Core\Contracts\TemplateRetriever;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        TemplateRetriever::class => LaravelProjectTemplateRetriever::class,
    ];

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Route::get('/new', IndexController::class);
    }
}
