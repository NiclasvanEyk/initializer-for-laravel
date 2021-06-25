<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;
use Illuminate\Validation\Rules\In;

class ValidPhpVersionOption extends In
{
    public function __construct()
    {
        parent::__construct(PhpVersion::values());
    }
}
