<?php

namespace Domains\Platform\DependencyResolver\Concrete;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\NodeJs\NpmDependency;
use Domains\Platform\DependencyResolver\DependencyResolverContainer;
use Illuminate\Support\Collection;

/**
 * @extends DependencyResolverContainer<NpmDependency>
 */
class NpmDependencyResolver extends DependencyResolverContainer
{
    public function __invoke(CreateProjectForm $form): Collection
    {
        return parent::__invoke($form)
            ->unique(fn (NpmDependency $option) => $option->id());
    }
}
