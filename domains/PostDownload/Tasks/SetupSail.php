<?php

namespace Domains\PostDownload\Tasks;

use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\VerbosePostDownloadTask;
use Domains\SourceCodeManipulation\Perl\Perl;
use Illuminate\Support\Collection;
use InitializerForLaravel\Composer\PhpVersion;

use function implode;

class SetupSail implements PostDownloadTaskGroup, PostDownloadTask, VerbosePostDownloadTask
{
    /**
     * @param  Collection<int, SailConfigurationOption>  $sailServices
     * @param  string  $phpVersion
     */
    public function __construct(
        private array $sailServices,
        private PhpVersion $phpVersion,
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
        return "initializerforlaravel/sail-php-{$this->phpVersion->value}:latest";
    }

    private function enumerateSailServices(): string
    {
        return implode(',', $this->sailServices);
    }

    private function composerInstallCommand(): string
    {
        return join(' && ', [
            // These steps are mostly the same as laravel.build does
            'composer install',
            "php -r \\\"file_exists('.env') || copy('.env.example', '.env');\\\"",
            'php artisan key:generate --ansi',
            // We explicitly select only the chosen sail services
            "php artisan sail:install --with={$this->enumerateSailServices()}",
            // We also adjust the runtime here based on the chosen PHP version
            Perl::replace(
                file: 'docker-compose.yml',
                pattern: '\.\/vendor\/laravel\/sail\/runtimes\/\d\.\d',
                replacement: ".\/vendor\/laravel\/sail\/runtimes\/{$this->phpVersion->value}",
            ),
            // and adjust the image name to match the PHP version
            Perl::replace(
                file: 'docker-compose.yml',
                pattern: 'sail-\d\.\d\/app',
                replacement: "sail-{$this->phpVersion->value}\/app",
            ),
        ]);
    }
}
