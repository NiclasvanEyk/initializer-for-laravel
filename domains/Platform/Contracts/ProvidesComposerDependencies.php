<?php

namespace Domains\Platform\Contracts;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

/**
 * Enables a {@link SectionServiceProvider} to add
 * {@link ComposerDependency}s.
 */
interface ProvidesComposerDependencies
{
    /**
     * @param CreateProjectForm $form
     * @return Collection<int, ComposerDependency>
     */
    public function composerDependencies(CreateProjectForm $form): Collection;
}
