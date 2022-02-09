<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;

class Broadcasting
{
    public function __construct(
        public readonly ?BroadcastingChannelOption $channel,
    ) {
    }
}
