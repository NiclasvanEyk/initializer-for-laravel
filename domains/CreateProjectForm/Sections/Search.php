<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Scout\AlgoliaScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\CustomScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\MeiliSearchScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;

/** @psalm-immutable */
class Search
{
    public function __construct(
        public ?ScoutDriver $driver,
    ) { }

    public static function driverForOption(string $option): ?ScoutDriver
    {
        return match($option) {
            ScoutDriverOption::MEILISEARCH => new MeiliSearchScoutDriver(),
            ScoutDriverOption::ALGOLIA => new AlgoliaScoutDriver(),
            ScoutDriverOption::CUSTOM => new CustomScoutDriver(),
            default => null,
        };
    }
}
