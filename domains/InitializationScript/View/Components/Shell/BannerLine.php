<?php

namespace Domains\InitializationScript\View\Components\Shell;

use Illuminate\View\Component;

class BannerLine extends Component
{
    public function render()
    {
        return "echo -e '┃ {{ \$slot }}';\n";
    }
}
