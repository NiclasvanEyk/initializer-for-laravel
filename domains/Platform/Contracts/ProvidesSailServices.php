<?php

namespace Domains\Platform\Contracts;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

/**
 * Enables a {@link SectionServiceProvider} to add
 * {@link SailConfigurationOption}s.
 */
interface ProvidesSailServices
{
    /**
     * @param CreateProjectForm $form
     * @return Collection
     */
    public function sailServices(CreateProjectForm $form): Collection;
}
