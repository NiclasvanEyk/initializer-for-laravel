<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Laravel\StarterKit\StarterKit;
use InitializerForLaravel\Core\Http\Mapping\Option;

class Authentication
{
    public function __construct(
        // TODO: How to resolve this correctly?
        public StarterKit $starterKit,

        #[Option('fortify')]
        public bool $usesFortify,

        #[Option('passport')]
        public bool $usesPassport,

        #[Option('socialite')]
        public bool $usesSocialite,
    ) {
    }
}
