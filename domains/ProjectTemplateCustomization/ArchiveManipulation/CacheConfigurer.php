<?php

namespace Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\CreateProjectForm\Sections\Cache\CacheDriver;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Cache\CacheOption as CacheAlias;
use Domains\CreateProjectForm\Sections\Cache\MemcacheDCacheDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class CacheConfigurer
{
    private array $cacheToServiceMap = [
        CacheOption::REDIS => 'redis',
        CacheAlias::MEMCACHED => 'memcached',
    ];

    public function adjustDefaults(
        ZipFile $archive,
        ?CacheDriver $cache,
    ): void {
        if ($cache === null) {
            return;
        }

        switch ($cache::class) {
            case RedisCacheDriver::class:
                $this->adjustForRedis($archive);
                break;

            case MemcacheDCacheDriver::class:
                $this->adjustForMemcached($archive);
                break;
            default:
        }
    }

    private function adjustForRedis(ZipFile $archive): void
    {
        $service = $this->cacheToServiceMap[CacheOption::REDIS];
        $exampleEnvContents = $archive->getEntryContents('.env.example');

        $archive->addFromString('.env.example', Str::replaceFirst(
            "REDIS_HOST=127.0.0.1",
            "REDIS_HOST=$service",
            $exampleEnvContents,
        ));
    }

    private function adjustForMemcached(ZipFile $archive): void
    {
        $service = $this->cacheToServiceMap[CacheAlias::MEMCACHED];
        $exampleEnvContents = $archive->getEntryContents('.env.example');

        $archive->addFromString('.env.example', Str::replaceFirst(
            "MEMCACHED_HOST=127.0.0.1",
            "MEMCACHED_HOST=$service",
            $exampleEnvContents,
        ));
    }
}
