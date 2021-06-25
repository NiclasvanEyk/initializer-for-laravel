<?php

namespace Domains\CreateProjectForm\Components;

/** @psalm-immutable  */
class Logo
{
    public function __construct(
        public string $src,
        public string $alt,
    ) { }
}
