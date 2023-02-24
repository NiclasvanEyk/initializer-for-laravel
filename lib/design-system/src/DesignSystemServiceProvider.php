<?php

namespace InitializerForLaravel\DesignSystem;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DesignSystemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::componentNamespace(
            'InitializerForLaravel\\DesignSystem\\Views\\Components',
            'initializer'
        );

        Blade::anonymousComponentPath(
            __DIR__.'/../resources/views/components',
            'initializer'
        );
    }
}
