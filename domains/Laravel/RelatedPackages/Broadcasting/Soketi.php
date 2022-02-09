<?php

namespace Domains\Laravel\RelatedPackages\Broadcasting;

use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use Domains\NodeJs\NpmDependency;

class Soketi extends NpmDependency
{
    public function id(): string
    {
        return BroadcastingChannelOption::SOKETI->value;
    }

    public function packageId(): string
    {
        return '@soketi/soketi';
    }

    public function name(): string
    {
        return 'Soketi';
    }

    public function description(): string
    {
        return 'Free, self-hosted, drop-in Pusher replacement implemented in Node.';
    }

    public function href(): string
    {
        return 'https://soketi.app';
    }
}
