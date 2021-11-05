<?php

namespace Domains\InitializationScript\View\Components\Shell;

use Illuminate\View\Component;

class Banner extends Component
{
    public function __construct(
        public string $title,
        public string $emoji = '🚀',
        public bool $error = false,
    ) {
    }

    public function render(): string
    {
        $red = $this->error ? ';31' : '';

        return <<<BLADE
        echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
        echo -e '┃ {{ \$emoji }} \033[1{$red}m{{ \$title }}\033[0m';
        {{ \$slot }}
        echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
        BLADE;
    }
}
