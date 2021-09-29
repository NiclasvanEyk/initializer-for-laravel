<?php

namespace Domains\InitializationScript\View\Components;

use Illuminate\View\Component;

class BannerLine extends Component
{
    public function render()
    {
        return "echo '┃ {{ \$slot }}';\n";
    }
}
