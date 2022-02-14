<?php

namespace Domains\CreateProjectForm\Sections\Scout;

enum ScoutDriver: string
{
    case NONE = 'none';
    case MEILISEARCH = 'meilisearch';
    case ALGOLIA = 'algolia';
    case DATABASE = 'database';
    case CUSTOM = 'custom';

    public static function default(): self
    {
        return self::MEILISEARCH;
    }
}
