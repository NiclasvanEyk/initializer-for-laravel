<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use function view;

readonly final class IndexController
{
    public function __invoke(Request $request, TemplateStorage $template): View
    {
        $currentLaravelVersion = $template->version() ?? "unknown";

        if (Str::startsWith($currentLaravelVersion, 'v')) {
            $currentLaravelVersion = Str::substr($currentLaravelVersion, 1);
        }

        return view('pages.new', [
            'currentLaravelVersion' => $currentLaravelVersion,
        ]);
    }
}
