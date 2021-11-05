<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Illuminate\View\Component;

/**
 * Bash trap, so the users are nudged towards opening an issue when something
 * goes wrong.
 */
class ErrorHandler extends Component
{
    public function __construct(public string $githubIssueLink)
    {
    }

    public function render(): string
    {
        return <<<'blade'
        function onError()
        {
            echo '';
            <x-shell::banner error emoji="💥" title="It looks like something went wrong!">
            <x-shell::banner-line />
            <x-shell::banner-line>Feel free to open an issue on GitHub by clicking on the link below.</x-shell::banner-line>
            <x-shell::banner-line />
            <x-shell::banner-line>Make sure to include helpful information such as:</x-shell::banner-line>
            <x-shell::banner-line>- the error output above</x-shell::banner-line>
            <x-shell::banner-line>- the configuration chosen before downloading the archive</x-shell::banner-line>
            <x-shell::banner-line>- your local environment (operating system, etc.)</x-shell::banner-line>
            <x-shell::banner-line>- other information that seems relevant to you</x-shell::banner-line>
            <x-shell::banner-line />
            <x-shell::banner-line><x-shell::bold>{{ $githubIssueLink }}</x-shell::bold></x-shell::banner-line>
            </x-shell::banner>
            echo '';
        }
        trap onError ERR;
        trap 'echo -e "\nCancelled"; exit 0;' INT;
        blade;
        // The first trap executes on error, the second one ensures that we
        // don't call the first when the user presses Ctrl-c.
    }
}
