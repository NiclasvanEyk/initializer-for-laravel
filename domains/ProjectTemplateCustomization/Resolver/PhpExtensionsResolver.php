<?php

namespace Domains\ProjectTemplateCustomization\Resolver;

use Domains\CreateProjectForm\CreateProjectForm;
use Illuminate\Support\Collection;

/**
 * Derives the set of php extensions, that need to be installed for the given
 * {@link CreateProjectForm} values.
 */
class PhpExtensionsResolver
{
    public function resolveFor(CreateProjectForm $form): array
    {
        return (new Collection([]))->unique()->values()->all();
    }
}
