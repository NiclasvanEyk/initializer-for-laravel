<?php

namespace Domains\Sections\Cache;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Cache\MemcacheDCacheDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\Laravel\Sail\Memcached;
use Domains\Laravel\Sail\Redis;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class CacheSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices
{
    public function sailServices(CreateProjectForm $form): Collection
    {
        $services = new Collection();

        if ($form->cache->driver instanceof RedisCacheDriver) {
            $services->add(new Redis());
        } elseif ($form->cache->driver instanceof MemcacheDCacheDriver) {
            $services->add(new Memcached());
        }

        return $services;
    }
}
