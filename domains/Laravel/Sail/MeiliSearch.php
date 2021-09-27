<?php

namespace Domains\Laravel\Sail;

class MeiliSearch extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'meilisearch';

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'MeiliSearch';
    }

    public function description(): string
    {
        return 'Simple and easy to use search-engine.';
    }

    public function href(): ?string
    {
        return 'https://www.meilisearch.com';
    }
}
