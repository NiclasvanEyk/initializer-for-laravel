<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Queue\BeanstalkdQueueDriver;
use Domains\CreateProjectForm\Sections\Queue\QueueDriver;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Queue\SqsQueueDriver;

class Queue
{
    public function __construct(
        public ?QueueDriver $driver,
        public bool $usesHorizon,
    ) { }

    public static function driverForOption(string $option): ?QueueDriver
    {
        return match($option) {
            QueueDriverOption::REDIS => new RedisQueueDriver(),
            QueueDriverOption::BEANSTALKD => new BeanstalkdQueueDriver(),
            QueueDriverOption::SQS => new SqsQueueDriver(),
            default => null,
        };
    }
}
