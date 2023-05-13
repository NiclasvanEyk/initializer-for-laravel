<?php

namespace Domains\CreateProjectForm\Sections;

class DevelopmentTools
{
    public function __construct(
        public bool $usesTelescope,
        public bool $usesEnvoy,
        public bool $usesPennant,
        public bool $usesDevcontainer,
    ) {
    }
}
