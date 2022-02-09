<?php

namespace Domains\ConfigAdjustment;

use Domains\ConfigAdjustment\Concerns\MakesArchiveAdjustments;
use Domains\CreateProjectForm\Sections\Cache\CacheDriver;
use Domains\CreateProjectForm\Sections\Cache\MemcacheDCacheDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use PhpZip\ZipFile;

class CacheAdjuster
{
    use MakesArchiveAdjustments;

    public function adjustDefaults(
        ZipFile $archive,
        ?CacheDriver $cache,
    ): void {
        if ($cache === null) {
            return;
        }

        switch ($cache::class) {
            case RedisCacheDriver::class:
                $this->replaceEnvExample($archive, [
                    'REDIS_HOST=127.0.0.1' => 'REDIS_HOST=redis',
                ]);
                break;

            case MemcacheDCacheDriver::class:
                $this->replaceEnvExample($archive, [
                    'MEMCACHED_HOST=127.0.0.1' => 'MEMCACHED_HOST=memcached',
                ]);
                break;
        }
    }
}
