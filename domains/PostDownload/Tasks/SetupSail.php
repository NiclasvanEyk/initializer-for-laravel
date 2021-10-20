<?php

namespace Domains\PostDownload\Tasks;

use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;
use Domains\Laravel\Sail\DatabaseOption;
use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\SourceCodeManipulation\Perl\Perl;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SetupSail implements PostDownloadTaskGroup, PostDownloadTask
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
        // We want to use the 80 container for v8.1, as there is no 81 container
        // published yet.
        $containerVersion = $this->phpVersion === PhpVersion::v8_1
            ? PhpVersion::v8_0
            : $this->phpVersion;

        $phpContainerVersion = Str::of($containerVersion)->remove('.');

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
            // These steps are mostly the same as laravel.build does
            'composer install --ignore-platform-reqs',
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
