<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\Sections\Notifications\NotificationChannelOptions as Channel;
use Illuminate\Support\Collection;

class Notifications
{
    /**
     * @param  Channel[]  $channels
     */
    public function __construct(public readonly array $channels)
    {
    }
}
