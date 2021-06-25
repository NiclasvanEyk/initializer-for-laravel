<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\Laravel\StarterKit\BreezeFrontend;
use Illuminate\Validation\Rules\In;

class ValidBreezeFrontendOption extends In
{
    public function __construct()
    {
        parent::__construct(BreezeFrontend::values());
    }
}
