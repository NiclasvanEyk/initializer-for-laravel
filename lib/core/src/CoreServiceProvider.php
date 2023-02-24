<?php

namespace InitializerForLaravel\Core;

use App\Console\Commands\UpdateTemplateCommand;
use Illuminate\Support\ServiceProvider;
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
    }
}
