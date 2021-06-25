<?php

namespace Domains\CreateProjectForm\Sections\Queue;

class SqsQueueDriver extends QueueDriver
{
    public function id()
    {
        return QueueDriverOption::SQS;
    }

    public function name()
    {
        return 'Amazon Simple Queue Service (SQS)';
    }

    public function description()
    {
        return 'Fully managed message queues for microservices, distributed systems, and serverless applications.';
    }

    public function href()
    {
        return 'https://aws.amazon.com/sqs';
    }
}
