<?php

namespace Domains\CreateProjectForm\Sections\Queue;

class BeanstalkdQueueDriver extends QueueDriver
{
    public function id(): string
    {
        return QueueDriverOption::BEANSTALKD;
    }

    public function name(): string
    {
        return 'Beanstalk';
    }

    public function description(): string
    {
        return 'A simple, fast work queue.';
    }

    public function href(): string
    {
        return 'https://beanstalkd.github.io';
    }
}
