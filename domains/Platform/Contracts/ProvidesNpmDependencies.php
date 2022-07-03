<?php

namespace Domains\Platform\Contracts;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\NodeJs\NpmDependency;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

/**
 * Enables a {@link SectionServiceProvider} to add
 * {@link NpmDependency}s.
 */
interface ProvidesNpmDependencies
{
    /**
     * @param  CreateProjectForm  $form
     * @return Collection<int, NpmDependency>
     */
    public function npmDependencies(CreateProjectForm $form): Collection;
}
