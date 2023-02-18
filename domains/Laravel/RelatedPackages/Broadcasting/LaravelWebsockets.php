<?php

namespace Domains\Laravel\RelatedPackages\Broadcasting;

use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;
use InitializerForLaravel\Composer\ComposerDependency;

class LaravelWebsockets extends ComposerDependency implements ProvidesInstallationInstructions
{
    public function id(): string
    {
        return BroadcastingChannelOption::LARAVEL_WEBSOCKETS->value;
    }

    public function packageId(): string
    {
        return 'beyondcode/laravel-websockets';
    }

    public function name(): string
    {
        return 'Laravel Websockets';
    }

    public function description(): string
    {
        return 'Free, self-hosted, drop-in Pusher replacement implemented in PHP.';
    }

    public function href(): ?string
    {
        return 'https://beyondco.de/docs/laravel-websockets';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Websockets',
            fn () => [
                "$artisan vendor:publish --provider=\"BeyondCode\LaravelWebSockets\WebSocketsServiceProvider\" --tag=\"migrations\"",
                "$artisan vendor:publish --provider=\"BeyondCode\LaravelWebSockets\WebSocketsServiceProvider\" --tag=\"config\"",
            ],
        );
    }
}
