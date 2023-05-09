<?php

namespace Domains\CreateProjectForm\Components\StarterKit;

use Illuminate\View\Component;

use function view;

class Selector extends Component
{
    public function render()
    {
        return view('starter-kit::starter-selector');
    }
}
