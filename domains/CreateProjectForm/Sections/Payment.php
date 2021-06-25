<?php

namespace Domains\CreateProjectForm\Sections;

class Payment
{
    public function __construct(
        public bool $usesPaddle,
        public bool $usesStripe,
        public bool $usesMollie,
    ) { }
}
