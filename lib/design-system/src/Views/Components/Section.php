<?php

namespace InitilizerForLaravel\DesignSystem\Views\Components;

use Illuminate\View\Component;
use InitializerForLaravel\Core\Configuration\Section as ViewModel;

class Section extends Component
{
    public function __construct(public readonly ViewModel $section)
    {
    }

    public function render()
    {
        return view('')
    }
}