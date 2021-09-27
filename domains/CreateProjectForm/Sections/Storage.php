<?php

namespace Domains\CreateProjectForm\Sections;

class Storage
{
    public function __construct(
        public bool $usesMinIO,
        public bool $usesSftp,
        public bool $usesCachedAdapter,
        public bool $usesS3,
    ) {
    }
}
