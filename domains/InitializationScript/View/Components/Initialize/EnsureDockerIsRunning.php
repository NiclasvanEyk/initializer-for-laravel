<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Illuminate\View\Component;

/**
 * Exits the script, when Docker is not running.
 */
class EnsureDockerIsRunning extends Component
{
    public function render(): string
    {
        return <<<SHELL
        if ! docker info > /dev/null 2>&1; then
            echo -e "Docker is not running." >&2;
            exit 1;
        fi
        SHELL;
    }
}
