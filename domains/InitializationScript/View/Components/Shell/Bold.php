<?php

namespace Domains\InitializationScript\View\Components\Shell;

use Illuminate\View\Component;

class Bold extends Component
{
    public function render(): string
    {
        return '\033[1m{{ $slot }}\033[0m';
    }
}
