<?php

namespace Domains\InitializationScript\View\Components;

use Illuminate\View\Component;

class Bold extends Component
{
    public function render()
    {
        return '\033[1m{{ $slot }}\033[0m';
    }
}
