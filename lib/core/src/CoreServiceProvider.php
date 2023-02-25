<?php

namespace InitializerForLaravel\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use InitializerForLaravel\Core\Console\Commands\UpdateTemplateCommand;
use InitializerForLaravel\Core\Contracts\TemplateStorage as TemplateStorageContract;
use InitializerForLaravel\Core\Storage\LocalTemplateStorage;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TemplateStorageContract::class,
            fn () => new LocalTemplateStorage('initializer.storage.options.base'),
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([UpdateTemplateCommand::class]);
        }

        $this->setupViews();
    }

    private function setupViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'initializer');
        Blade::componentNamespace('InitializerForLaravel\\Core\\View\\Components', 'initializer');
    }
}
