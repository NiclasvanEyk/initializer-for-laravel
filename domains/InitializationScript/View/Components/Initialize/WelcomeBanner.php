<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Illuminate\View\Component;

/**
 * Banner that is shown before anything is executed.
 */
class WelcomeBanner extends Component
{
    public function render(): string
    {
        return <<<'BLADE'
        echo '';
        <x-shell::banner title="Initializer for Laravel">
        <x-shell::banner-line />
        <x-shell::banner-line>This script will complete the rest of the setup needed to install the</x-shell::banner-line>
        <x-shell::banner-line>chosen components into your fresh application. This might require</x-shell::banner-line>
        <x-shell::banner-line>downloading Docker containers or requiring packages via composer</x-shell::banner-line>
        <x-shell::banner-line>multiple times, so it can take a while to complete.</x-shell::banner-line>
        </x-shell::banner>
        BLADE;
    }
}
