<?php

namespace Domains\Platform\DependencyResolver\Concrete;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\Sail\SailConfigurationOption;
use Domains\Platform\DependencyResolver\DependencyResolverContainer;
use Illuminate\Support\Collection;

/**
 * @extends DependencyResolverContainer<SailConfigurationOption>
 */
class SailServiceResolver extends DependencyResolverContainer
{
    public function __invoke(CreateProjectForm $form): Collection
    {
        return parent::__invoke($form)
            ->unique(fn (SailConfigurationOption $option) => $option->id());
    }
}
