<?php

namespace Domains\ProjectTemplate;

use Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand;
use Illuminate\Support\ServiceProvider;
use Laravel\Installer\Console\NewCommand;

class ProjectTemplateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            UpdateTemplateCommand::class,
            NewCommand::class,
        ]);
    }
}
