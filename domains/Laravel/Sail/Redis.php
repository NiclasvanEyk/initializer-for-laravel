<?php


namespace Domains\Laravel\Sail;


use Domains\CreateProjectForm\Sections\Cache\CacheOption;

class Redis extends SailConfigurationOption
{
    const REPOSITORY_KEY = CacheOption::REDIS;

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'Redis';
    }

    function description(): string
    {
        return 'An advanced key-value store useful for caching.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/redis';
    }
}
