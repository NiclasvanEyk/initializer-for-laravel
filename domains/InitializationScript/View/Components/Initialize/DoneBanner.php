<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Illuminate\View\Component;

/**
 * Banner showing further instructions, once the initialization process has been
 * successfully completed.
 */
class DoneBanner extends Component
{
    public function __construct(public array $links)
    {
    }

    public function render(): string
    {
        return <<<'BLADE'
        echo '';
        <x-shell::banner title="Done!">
        <x-shell::banner-line />
        <x-shell::banner-line>You can now have a look at README.md, for further instructions, guides</x-shell::banner-line>
        <x-shell::banner-line>and links to the installed components.</x-shell::banner-line>
        <x-shell::banner-line />
        <x-shell::banner-line>Some helpful links:</x-shell::banner-line>
        @foreach($links as $link)
        <x-shell::banner-line>- {{$link->title}} {{ $link->href }}</x-shell::banner-line>
        @endforeach
        </x-shell::banner>
        echo '';
        BLADE;
    }
}
