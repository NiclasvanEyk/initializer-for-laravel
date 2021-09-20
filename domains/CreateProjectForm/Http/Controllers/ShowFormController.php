<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ShowFormController
{
    public function __invoke(TemplateStorage $templateStorage): View
    {
        $currentLaravelVersion = $templateStorage->currentVersion();

        if (Str::startsWith($currentLaravelVersion, 'v')) {
            $currentLaravelVersion = Str::substr($currentLaravelVersion, 1);
        }

        return view('welcome', [
            'currentLaravelVersion' => $currentLaravelVersion,
        ]);
    }
}
