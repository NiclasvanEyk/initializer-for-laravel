<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;
use Illuminate\Validation\Rules\In;

class ValidScoutDriverOption extends In
{
    public function __construct()
    {
        parent::__construct(ScoutDriverOption::values());
    }
}
