<?php


namespace App\Sail;


class Redis extends SailConfigurationOption
{
    function id(): string
    {
        return 'cache-redis';
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
