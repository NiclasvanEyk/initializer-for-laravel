<?php

namespace Domains\ProjectTemplateCustomization;

use Domains\CreateProjectForm\Support\Str;
use Domains\ProjectTemplateCustomization\View\Components\Banner;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ProjectCreationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/templates', 'template');

        Blade::componentNamespace(
            Str::namespace(Banner::class),
            'shell',
        );
    }
}
