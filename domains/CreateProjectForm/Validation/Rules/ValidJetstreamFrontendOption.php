<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\Laravel\StarterKit\JetstreamFrontend;
use Illuminate\Validation\Rules\In;

class ValidJetstreamFrontendOption extends In
{
    public function __construct()
    {
        parent::__construct(JetstreamFrontend::values());
    }
}
