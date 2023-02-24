<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Cache\CacheDriver;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Cache\MemcacheDCacheDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use InitializerForLaravel\Core\Http\Mapping\Choice;

class Cache
{
    public function __construct(
        #[Choice('cache-driver')]
        public ?CacheDriver $driver,
    ) {
    }

    public static function driverForOption(string $option): ?CacheDriver
    {
        return match ($option) {
            CacheOption::REDIS => new RedisCacheDriver(),
            CacheOption::MEMCACHED => new MemcacheDCacheDriver(),
            CacheOption::NONE => null,
            default => null,
        };
    }
}
