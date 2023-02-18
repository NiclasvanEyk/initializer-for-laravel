<?php

namespace InitializerForLaravel\Core;

use Illuminate\Support\ServiceProvider;
use InitializerForLaravel\Core\Contracts\TemplateStorage as TemplateStorageContract;
use InitializerForLaravel\Core\Storage\LocalTemplateStorage;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TemplateStorageContract::class,
            function (): TemplateStorageContract {
                return new LocalTemplateStorage(
                    storage_path('laravel-releases')
                );
            }
        );
    }
}
