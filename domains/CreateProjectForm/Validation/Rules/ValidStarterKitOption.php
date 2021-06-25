<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\Laravel\StarterKit\StarterKit;
use Illuminate\Validation\Rules\In;

class ValidStarterKitOption extends In
{
    public function __construct()
    {
        parent::__construct(StarterKit::values());
    }
}
