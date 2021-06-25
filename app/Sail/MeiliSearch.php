<?php

namespace App\Sail;

class MeiliSearch extends SailConfigurationOption
{
    function id(): string
    {
        return 'search-meilisearch';
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
