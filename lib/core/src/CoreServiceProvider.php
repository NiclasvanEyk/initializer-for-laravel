<?php

namespace InitializerForLaravel\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use InitializerForLaravel\Core\Console\Commands\UpdateTemplateCommand;
use InitializerForLaravel\Core\Contracts\TemplateStorage as TemplateStorageContract;
use InitializerForLaravel\Core\Storage\LocalTemplateStorage;
use function config;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([UpdateTemplateCommand::class]);
        }

        $this->mergeConfigFrom(__DIR__."/../config/initializer.php", "initializer");

        $this->setupViews();
        $this->setupTemplateStorage();
    }

    private function setupViews(): void
    {
        Blade::componentNamespace(
            'InitializerForLaravel\\Core\\View\\Components',
            'initializer'
        );
        Blade::anonymousComponentPath(
            __DIR__.'/../resources/views/components',
            'initializer'
        );
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'initializer');
    }

    private function setupTemplateStorage(): void
    {
        if (config('initializer.storage.driver') === LocalTemplateStorage::class) {
            $this->app->bind(
                TemplateStorageContract::class,
                function () {
                    return new LocalTemplateStorage(
                        config('initializer.storage.options.base')
                    );
                }
            );
        }
    }
}
