<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Notifications\NotificationChannelOptions as Channel;

class Notifications
{
    /**
     * @param  Channel[]  $channels
     */
    public function __construct(public readonly array $channels)
    {
    }
}
