<?php

namespace Domains\CreateProjectForm\Sections\Cache;

class DynamoDBCacheDBDriver extends CacheDriver
{
    public function id(): string
    {
        return CacheOption::DYNAMO_DB;
    }

    public function name(): string
    {
        return 'DynamoDB';
    }

    public function description(): string
    {
        return 'Use a DynamoDB table as your cache.';
    }

    public function href(): string
    {
        return 'https://laravel.com/docs/cache#dynamodb';
    }
}
