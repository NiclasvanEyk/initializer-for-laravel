<?php

namespace Domains\CreateProjectForm\Sections;

class Testing
{
    public function __construct(
        public bool $usesDusk,
        public bool $usesPest,
    ) {
    }
}
