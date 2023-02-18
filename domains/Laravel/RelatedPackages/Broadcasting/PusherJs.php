<?php

namespace Domains\Laravel\RelatedPackages\Broadcasting;

use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use InitializerForLaravel\Packagist\NpmDependency;

class PusherJs extends NpmDependency
{
    public function id(): string
    {
        return BroadcastingChannelOption::PUSHER->value;
    }

    public function packageId(): string
    {
        return 'pusher-js';
    }

    public function name(): string
    {
        return 'Pusher';
    }

    public function description(): string
    {
        return 'Realtime communication between servers, apps and devices';
    }

    public function href(): string
    {
        return 'https://pusher.com';
    }
}
