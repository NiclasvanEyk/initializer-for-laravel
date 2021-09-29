<?php

namespace Domains\InitializationScript\View\Components;

use Illuminate\View\Component;

class Banner extends Component
{
    public function __construct(
        public string $title,
    ) {
    }

    public function render()
    {
        return <<<BLADE
        echo '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
        echo '┃ 🚀 \033[1m{{ \$title }}\033[0m';
        {{ \$slot }}
        echo '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
        BLADE;
    }
}
