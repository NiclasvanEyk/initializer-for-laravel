<?php

namespace Domains\CreateProjectForm\Sections\Scout;

use Domains\Support\Enum\EmulatesEnum;

class ScoutDriverOption
{
    use EmulatesEnum;

    const NONE = 'none';
    const MEILISEARCH = 'meilisearch';
    const ALGOLIA = 'algolia';
    const CUSTOM = 'custom';

    public static function default()
    {
        return self::MEILISEARCH;
    }
}
