<?php


namespace App\Sail;


class Memcached extends SailConfigurationOption
{
    function id(): string
    {
        return 'cache-memcached';
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
