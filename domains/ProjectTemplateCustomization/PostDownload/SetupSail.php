<?php

namespace Domains\ProjectTemplateCustomization\PostDownload;

use Dflydev\DotAccessData\Data;
use Domains\Laravel\Sail\DatabaseOption;
use Domains\Laravel\Sail\SailConfigurationOption;
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
        $sailServices = $this->sailServices
            ->map(function (SailConfigurationOption|DatabaseOption $option) {
                return $option instanceof DatabaseOption
                    ? $option->sailId()
                    : $option->id();
            })
            ->join(',');
        $phpContainerVersion = Str::of($this->phpVersion)->remove('.');
        $bashCommand = join(' && ', [
            'composer install',
            "php -r \\\"file_exists('.env') || copy('.env.example', '.env');\\\"",
            "php artisan key:generate --ansi",
            "php artisan sail:install --with=$sailServices",
        ]);

        return <<<SHELL
        docker run --rm \
            -v "$(pwd)":/opt \
            -w /opt \
            laravelsail/php$phpContainerVersion-composer:latest \
            bash -c "$bashCommand"
        SHELL;
    }
}
