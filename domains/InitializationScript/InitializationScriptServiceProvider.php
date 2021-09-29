<?php

namespace Domains\InitializationScript;

use Carbon\Laravel\ServiceProvider;
use Domains\ArchiveManipulation\RegistersArchiveManipulators;
use Domains\CreateProjectForm\Support\Str;
use Domains\InitializationScript\View\Components\Banner;
use Illuminate\Support\Facades\Blade;

class InitializationScriptServiceProvider extends ServiceProvider
{
    use RegistersArchiveManipulators;

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/templates', 'template');

        Blade::componentNamespace(
            Str::namespace(Banner::class),
            'shell',
        );

        $this->registerArchiveManipulator(
            InitializationScriptArchiveManipulator::class,
        );
    }
}
