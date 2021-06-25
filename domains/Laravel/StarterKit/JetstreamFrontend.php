<?php

namespace Domains\Laravel\StarterKit;

use Domains\Support\Enum\EmulatesEnum;

class JetstreamFrontend
{
    use EmulatesEnum;

    const LIVEWIRE = 'livewire';
    const INERTIA = 'inertia';

    public function __construct(public string $name) { }

    public function __toString(): string
    {
        return $this->name;
    }
}
