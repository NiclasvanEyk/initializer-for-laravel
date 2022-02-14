<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;

/** @psalm-immutable */
class Search
{
    public function __construct(
        public ScoutDriver $driver,
    ) {
    }
}
