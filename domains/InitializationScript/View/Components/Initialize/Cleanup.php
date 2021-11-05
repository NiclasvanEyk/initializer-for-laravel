<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Illuminate\View\Component;

/**
 * Deletes files that are not necessary, after the initialization process has
 * been successfully completed.
 */
class Cleanup extends Component
{
    /**
     * @param  string  $initializationScript  The name of the initialization script.
     */
    public function __construct(public string $initializationScript)
    {
    }

    public function render(): string
    {
        return <<<'BLADE'
        echo "Finished setup, removing {{ $initializationScript }} and TODOs in README.md!";
        rm "./{{ $initializationScript }}";

        # Remove TODO in readme
        perl -0777 -pi -e 's/<!-- Initializer for Laravel Todos START  -->.*<!-- Initializer for Laravel Todos END  -->//gs' README.md
        BLADE;
    }
}
