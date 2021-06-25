<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Enables the creation of a permalink for the currently selected form values.
 */
class PermalinkController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $parameters = collect($request->all())
            ->only(CreateProjectRequestParameter::values())
            ->except([
                // These are very likely to differ between projects, so we don't
                // include / support them to be read from the query params
                CreateProjectRequestParameter::PROJECT,
                CreateProjectRequestParameter::DESCRIPTION,
            ])
            ->toArray();

        return redirect(route('root', $parameters));
    }
}
