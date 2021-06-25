<?php

namespace Domains\CreateProjectForm\Sections\Queue;

use Domains\Support\Enum\EmulatesEnum;

class QueueDriverOption
{
    use EmulatesEnum;

    const NONE = 'none';
    const REDIS = 'redis';
    const BEANSTALKD = 'beanstalkd';
    const SQS = 'sqs';

    public static function default()
    {
        return self::NONE;
    }
}
