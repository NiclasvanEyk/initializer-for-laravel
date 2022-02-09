<?php

namespace Domains\Laravel\RelatedPackages\Broadcasting;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;

class Pusher extends ComposerDependency
{
    public function id(): string
    {
        return BroadcastingChannelOption::PUSHER->value;
    }

    public function packageId(): string
    {
        return 'pusher/pusher-php-server';
    }

    public function name(): string
    {
        return 'Pusher';
    }

    public function description(): string
    {
        return 'Realtime communication between servers, apps and devices';
    }

    public function href(): ?string
    {
        return 'https://pusher.com';
    }
}
