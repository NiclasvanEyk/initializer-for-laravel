<?php

namespace Domains\Laravel\Sail;

class MeiliSearch extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'meilisearch';

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'MeiliSearch';
    }

    function description(): string
    {
        return 'Simple and easy to use search-engine.';
    }

    public function href(): ?string
    {
        return 'https://www.meilisearch.com';
    }
}
