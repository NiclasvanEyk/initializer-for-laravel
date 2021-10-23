<?php

namespace Domains\DockerImages;

use Domains\DockerImages\Console\Commands\UpdateSailImages;
use Illuminate\Support\ServiceProvider;

class DockerImagesServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([UpdateSailImages::class]);
        }
    }
}
