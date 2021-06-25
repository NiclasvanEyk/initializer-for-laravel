<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\Laravel\Sail\DatabaseOption as SailDatabaseOption;

class Database
{
    public function __construct(
        public SailDatabaseOption|SailConfigurationOption $database,
    ) { }
}
