<?php

namespace Domains\ConfigAdjustment;

use Domains\ArchiveManipulation\RegistersArchiveManipulators;
use Illuminate\Support\ServiceProvider;

class ConfigAdjustmentServiceProvider extends ServiceProvider
{
    use RegistersArchiveManipulators;

    public function register()
    {
        $this->registerArchiveManipulator(
            ConfigAdjustmentArchiveManipulator::class,
        );
    }
}
