<?php

namespace Domains\CreateProjectForm\Components\StarterKit;

use Domains\Laravel\StarterKit\StarterKit;
use Illuminate\View\Component;

class Laravel extends Component
{
    public string $id = StarterKit::LARAVEL;
    public string $heading = 'Laravel';

    public function __construct(public string $model)
    {
    }

    public function render()
    {
        return view('starter-kit::laravel');
    }
}
