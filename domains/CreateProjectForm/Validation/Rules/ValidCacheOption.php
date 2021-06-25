<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Illuminate\Validation\Rules\In;

class ValidCacheOption extends In
{
    public function __construct()
    {
        parent::__construct(CacheOption::values());
    }
}
