<?php

namespace Domains\ProjectTemplate;

use Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Laravel\Installer\Console\NewCommand;

/**
 * @codeCoverageIgnore
 */
class ProjectTemplateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            UpdateTemplateCommand::class,
            NewCommand::class,
        ]);

        $this->app->singleton(
            TemplateStorage::class,
            fn () => new TemplateStorage(
                Storage::disk('laravel-releases'),
                config('filesystems.disks.laravel-releases.root')
            ),
        );

        $this->setupSchedule();
    }

    private function setupSchedule(): void
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule
                ->command(UpdateTemplateCommand::class)
                ->hourly()
                ->appendOutputTo(storage_path('update-template.log'));
        });
    }
}
