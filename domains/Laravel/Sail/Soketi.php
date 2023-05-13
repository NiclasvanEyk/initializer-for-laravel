<?php

namespace Domains\Laravel\Sail;

class Soketi extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'soketi';

    public function id() : string
    {
        return self::REPOSITORY_KEY;
    }

    public function name() : string
    {
        return 'Soketi';
    }

    public function description() : string
    {
        return 'Free, self-hosted, drop-in Pusher replacement implemented in Node.';
    }

    public function href() : ?string
    {
        return 'https://soketi.app';
    }
}