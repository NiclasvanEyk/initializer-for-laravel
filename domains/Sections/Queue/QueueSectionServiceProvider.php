<?php

namespace Domains\Sections\Queue;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\Laravel\Sail\Redis;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class QueueSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices
{
    public function sailServices(CreateProjectForm $form): Collection
    {
        $services = new Collection();

        if ($form->queue->driver instanceof RedisQueueDriver) {
            $services->add(new Redis());
        }

        return $services;
    }
}
