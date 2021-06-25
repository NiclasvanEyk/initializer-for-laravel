<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Database\DatabaseOption;
use Illuminate\Validation\Rules\In;

class ValidDatabaseOption extends In
{
    public function __construct()
    {
        parent::__construct(DatabaseOption::values());
    }
}
