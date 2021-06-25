<?php

namespace Domains\ProjectTemplate;

use Domains\ProjectTemplate\Console\Commands\DownloadCommand;
use Illuminate\Support\ServiceProvider;
use Laravel\Installer\Console\NewCommand;

class ProjectTemplateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DownloadCommand::class,
                NewCommand::class,
            ]);
        }
    }
}
