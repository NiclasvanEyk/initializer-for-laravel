<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Laravel\Sail\DatabaseOption as SailDatabaseOption;
use Domains\Laravel\Sail\SailConfigurationOption;

class Database
{
    public function __construct(
        public SailDatabaseOption|SailConfigurationOption $database,
        public bool $useDbal,
    ) {
    }
}
