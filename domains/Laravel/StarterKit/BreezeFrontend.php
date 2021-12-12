<?php

namespace Domains\Laravel\StarterKit;

use Domains\Support\Enum\EmulatesEnum;

class BreezeFrontend
{
    use EmulatesEnum;

    const BLADE = 'blade';
    const REACT = 'react';
    const VUE = 'vue';
    const API = 'api';

    public function __construct(public string $name)
    {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
