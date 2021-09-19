<?php

namespace Domains\CreateProjectForm\Sections\Queue;

class SqsQueueDriver extends QueueDriver
{
    public function id(): string
    {
        return QueueDriverOption::SQS;
    }

    public function name(): string
    {
        return 'Amazon Simple Queue Service (SQS)';
    }

    public function description(): string
    {
        return 'Fully managed message queues for microservices, distributed systems, and serverless applications.';
    }

    public function href(): string
    {
        return 'https://aws.amazon.com/sqs';
    }
}
