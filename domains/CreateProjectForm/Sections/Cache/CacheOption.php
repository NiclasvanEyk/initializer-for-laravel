<?php

namespace Domains\CreateProjectForm\Sections\Cache;

use Domains\Support\Enum\EmulatesEnum;

class CacheOption
{
    use EmulatesEnum;

    public const REDIS = 'redis';
    public const MEMCACHED = 'memcached';
    public const DYNAMO_DB = 'dynamodb';
    public const NONE = 'none';

    public static function default(): string
    {
        return self::REDIS;
    }
}
