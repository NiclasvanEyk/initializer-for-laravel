<?php

namespace Domains\ProjectTemplateCustomization\Resolver;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Cache\MemcacheDCacheDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\Laravel\Sail\Mailhog;
use Domains\Laravel\Sail\MeiliSearch;
use Domains\Laravel\Sail\Memcached;
use Domains\Laravel\Sail\MinIO;
use Domains\Laravel\Sail\Redis;
use Domains\Laravel\Sail\SailConfigurationOption;
use Illuminate\Support\Collection;

class SailServiceResolver
{
    /**
     * @return Collection<int, SailConfigurationOption>
     */
    public function resolveFor(CreateProjectForm $form): Collection
    {
        /** @var array<int, SailConfigurationOption> $services */
        $services = [$form->database->database];

        if ($form->cache->driver instanceof RedisCacheDriver) {
            $services[] = new Redis();
        } elseif ($form->cache->driver instanceof MemcacheDCacheDriver) {
            $services[] = new Memcached();
        }

        if ($form->queue->driver instanceof RedisQueueDriver) {
            $services[] = new Redis();
        }

        if ($form->search->driver === ScoutDriver::MEILISEARCH) {
            $services[] = new MeiliSearch();
        }

        if ($form->mail->usesMailhog) {
            $services[] = new Mailhog();
        }

        if ($form->storage->usesMinIO) {
            $services[] = new MinIO();
        }

        return (new Collection($services))
            // Redis might be in there multiple times
            ->unique(function (SailConfigurationOption $service) {
                return $service->id();
            })
            ->values();
    }
}
