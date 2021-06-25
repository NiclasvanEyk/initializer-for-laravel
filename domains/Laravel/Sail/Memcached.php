<?php


namespace Domains\Laravel\Sail;


use Domains\CreateProjectForm\Sections\Cache\CacheOption as CacheAlias;

class Memcached extends SailConfigurationOption
{
    const REPOSITORY_KEY = CacheAlias::MEMCACHED;

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'Memcached';
    }

    function description(): string
    {
        return 'High-performance, distributed memory object caching system.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/cache#memcached';
    }
}
