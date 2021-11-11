<?php

namespace Domains\PostDownload\Tasks;

use Domains\Laravel\Sail\DatabaseOption;
use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\VerbosePostDownloadTask;
use Domains\SourceCodeManipulation\Perl\Perl;
use Illuminate\Support\Collection;

class SetupSail implements PostDownloadTaskGroup, PostDownloadTask, VerbosePostDownloadTask
{
    public function __construct(
        private Collection $sailServices,
        private string $phpVersion,
    ) {
    }

    public function title(): string
    {
        return 'Install dependencies and set up Laravel Sail';
    }

    public function tasks(): array
    {
        return [$this];
    }

    public function shellDescription(): string
    {
        return "Running initial installation inside '{$this->phpContainer()}'";
    }

    public function shell(): string
    {
        return <<<SHELL
        docker run --rm \
            -e WWWUSER=$(id -u) \
            -v "$(pwd)":/opt \
            -w /opt \
            "{$this->phpContainer()}" \
            bash -c "{$this->composerInstallCommand()}"
        SHELL;
    }

    private function phpContainer(): string
    {
        return "initializerforlaravel/sail-php-$this->phpVersion:latest";
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
            // These steps are mostly the same as laravel.build does
            'composer install',
            "php -r \\\"file_exists('.env') || copy('.env.example', '.env');\\\"",
            'php artisan key:generate --ansi',
            // We explicitly select only the chosen sail services
            "php artisan sail:install --with={$this->sailServices()}",
            // We also adjust the runtime here based on the chosen PHP version
            Perl::replace(
                file: 'docker-compose.yml',
                pattern: '\.\/vendor\/laravel\/sail\/runtimes\/\d\.\d',
                replacement: ".\/vendor\/laravel\/sail\/runtimes\/$this->phpVersion",
            ),
            // and adjust the image name to match the PHP version
            Perl::replace(
                file: 'docker-compose.yml',
                pattern: 'sail-\d\.\d\/app',
                replacement: "sail-$this->phpVersion\/app",
            ),
        ]);
    }
}
