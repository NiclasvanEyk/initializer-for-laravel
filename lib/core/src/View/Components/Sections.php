<?php

namespace InitializerForLaravel\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Sections extends Component
{
    public function __construct(public array $sections = [])
    {
    }

    public function render(): View
    {
        return view('x-initializer::sections');
    }
}
