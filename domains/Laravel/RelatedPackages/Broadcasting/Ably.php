<?php

namespace Domains\Laravel\RelatedPackages\Broadcasting;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;

class Ably extends ComposerDependency
{
    public function id(): string
    {
        return BroadcastingChannelOption::ABLY->value;
    }

    public function packageId(): string
    {
        return 'ably/ably-php';
    }

    public function name(): string
    {
        return 'Ably';
    }

    public function description(): string
    {
        return 'The platform to power synchronized digital experiences in realtime.';
    }

    public function href(): ?string
    {
        return 'https://ably.com';
    }
}
