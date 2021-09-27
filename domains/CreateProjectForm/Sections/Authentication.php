<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Laravel\StarterKit\StarterKit;

class Authentication
{
    public function __construct(
        public StarterKit $starterKit,
        public bool $usesFortify,
        public bool $usesPassport,
        public bool $usesSocialite,
    ) {
    }
}
