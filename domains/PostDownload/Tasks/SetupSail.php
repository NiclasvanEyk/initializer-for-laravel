<?php

namespace Domains\PostDownload\Tasks;

use Domains\Laravel\Sail\DatabaseOption;
use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SetupSail implements PostDownloadTaskGroup, PostDownloadTask
{
    public function __construct(
        private Collection $sailServices,
        private string $phpVersion,
    ) { }

    public function title(): string
    {
        return "Install dependencies and set up Laravel Sail";
    }

    public function tasks(): array
    {
        return [$this];
    }

    public function shell(): string
    {
        return <<<SHELL
        docker run --rm \
            -v "$(pwd)":/opt \
            -w /opt \
            {$this->phpContainer()} \
            bash -c "{$this->composerInstallCommand()}"
        SHELL;
    }

    private function phpContainer(): string
    {
        $phpContainerVersion = Str::of($this->phpVersion)->remove('.');

        return "laravelsail/php$phpContainerVersion-composer:latest";
    }

    private function sailServices(): string
    {
        return $this->sailServices
            ->map(function (SailConfigurationOption|DatabaseOption $option) {
                return $option instanceof DatabaseOption
                    ? $option->sailId()
                    : $option->id();
            })
            ->join(',');
    }

    private function composerInstallCommand(): string
    {
        return join(' && ', [
            'ls -alh',
            'composer install --ignore-platform-reqs',
            "php -r \\\"file_exists('.env') || copy('.env.example', '.env');\\\"",
            "php artisan key:generate --ansi",
            "php artisan sail:install --with={$this->sailServices()}",
        ]);
    }
}
