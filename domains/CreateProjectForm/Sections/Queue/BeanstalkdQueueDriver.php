<?php

namespace Domains\CreateProjectForm\Sections\Queue;

class BeanstalkdQueueDriver extends QueueDriver
{
    public function id()
    {
        return QueueDriverOption::BEANSTALKD;
    }

    public function name()
    {
        return 'Beanstalk';
    }

    public function description()
    {
        return 'A simple, fast work queue.';
    }

    public function href()
    {
        return 'https://beanstalkd.github.io';
    }
}
