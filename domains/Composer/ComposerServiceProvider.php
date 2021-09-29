<?php

namespace Domains\Composer;

use Domains\ArchiveManipulation\RegistersArchiveManipulators;
use Domains\Composer\ProjectTemplateCustomization\ComposerJsonArchiveManipulator;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    use RegistersArchiveManipulators;

    public function register()
    {
        $this->registerArchiveManipulator(
            ComposerJsonArchiveManipulator::class
        );
    }
}
