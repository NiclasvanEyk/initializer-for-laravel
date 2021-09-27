<?php

namespace Domains\CreateProjectForm\Components\StarterKit;

use Illuminate\View\Component;

class Option extends Component
{
    public function __construct(
        public string $id,
        public string $model,
        public string $heading,
        public string $logoSrc,
        public string $logoAlt,
        public string $href,
        public string $color = 'red',
    ) {
    }

    public function backgroundInputStyles(): string
    {
        return match ($this->color) {
            'yellow' => 'dark:bg-opacity-10 dark:bg-yellow-800 bg-yellow-100',
            'indigo' => 'dark:bg-opacity-10 dark:bg-indigo-800 bg-indigo-100',
            default => 'dark:bg-opacity-10 dark:bg-red-800 bg-red-100'
        };
    }

    public function focusStyles(): string
    {
        return match ($this->color) {
            'yellow' => 'focus:ring-yellow-500 text-yellow-600',
            'indigo' => 'focus:ring-indigo-500 text-indigo-600',
            default => 'focus:ring-red-500 text-red-600'
        };
    }

    public function backgroundSelectedStyles(): string
    {
        return match ($this->color) {
            'yellow' => 'dark:bg-opacity-30 dark:bg-yellow-700 bg-yellow-50 bg-opacity-50 border-yellow-500',
            'indigo' => 'dark:bg-opacity-30 dark:bg-indigo-700 bg-indigo-50 bg-opacity-50 border-indigo-500',
            default => 'dark:bg-opacity-30 dark:bg-red-700 bg-red-50 bg-opacity-50 border-red-500'
        };
    }

    public function render()
    {
        return view('starter-kit::starter-option');
    }
}
