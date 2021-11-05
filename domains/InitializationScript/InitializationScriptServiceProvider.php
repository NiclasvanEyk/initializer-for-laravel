<?php

namespace Domains\InitializationScript;

use Carbon\Laravel\ServiceProvider;
use Domains\ArchiveManipulation\RegistersArchiveManipulators;
use Domains\CreateProjectForm\Support\Str;
use Domains\InitializationScript\View\Components\Shell\Banner;
use Domains\InitializationScript\View\Components\Initialize\WelcomeBanner;
use Illuminate\Support\Facades\Blade;

class InitializationScriptServiceProvider extends ServiceProvider
{
    use RegistersArchiveManipulators;

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/templates', 'template');

        $this->registerBladeComponentsNextTo(Banner::class, 'shell');
        $this->registerBladeComponentsNextTo(WelcomeBanner::class, 'initialize');

        $this->registerArchiveManipulator(
            InitializationScriptArchiveManipulator::class,
        );
    }

    /**
     * Registers all Blade components directly next to $exampleComponent under
     * the $prefix namespace.
     */
    private function registerBladeComponentsNextTo(
        string $exampleComponent,
        string $prefix,
    ): void {
        Blade::componentNamespace(Str::namespace($exampleComponent), $prefix);
    }
}
