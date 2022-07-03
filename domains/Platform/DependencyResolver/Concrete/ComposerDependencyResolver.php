<?php

namespace Domains\Platform\DependencyResolver\Concrete;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Platform\DependencyResolver\DependencyResolverContainer;
use Illuminate\Support\Collection;

/**
 * @extends DependencyResolverContainer<ComposerDependency>
 */
class ComposerDependencyResolver extends DependencyResolverContainer
{
    public function __invoke(CreateProjectForm $form): Collection
    {
        return parent::__invoke($form)
            ->unique(fn (ComposerDependency $option) => $option->id());
    }
}
