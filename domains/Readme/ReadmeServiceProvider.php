<?php

namespace Domains\Readme;

use Domains\ArchiveManipulation\RegistersArchiveManipulators;
use Illuminate\Support\ServiceProvider;

class ReadmeServiceProvider extends ServiceProvider
{
    use RegistersArchiveManipulators;

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/templates', 'template');
        $this->registerArchiveManipulator(ReadmeArchiveManipulator::class);
    }
}
