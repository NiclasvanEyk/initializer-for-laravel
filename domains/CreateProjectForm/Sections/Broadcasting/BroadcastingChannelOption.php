<?php

namespace Domains\CreateProjectForm\Sections\Broadcasting;

enum BroadcastingChannelOption: string
{
    case NONE = 'none';
    case PUSHER = 'pusher';
    case ABLY = 'ably';
    case LARAVEL_WEBSOCKETS = 'laravel-websockets';
    case SOKETI = 'soketi';
//    case REDIS = 'redis'; // maybe later

    public static function default(): self
    {
        return self::NONE;
    }
}
