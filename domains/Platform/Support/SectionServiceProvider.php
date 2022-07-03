<?php

namespace Domains\Platform\Support;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Platform\Contracts\ProvidesComposerDependencies;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\DependencyResolver\Concrete\ComposerDependencyResolver;
use Domains\Platform\DependencyResolver\Concrete\SailServiceResolver;

abstract class SectionServiceProvider
{
    public function boot(
        SailServiceResolver $sail,
        ComposerDependencyResolver $composer,
    ): void
    {
        if ($this instanceof ProvidesSailServices::class) {
            $sail->register(function (CreateProjectForm $form) {
                return $this->sailServices($form);
            });
        }

        if ($this instanceof ProvidesComposerDependencies::class) {
            $composer->register(function (CreateProjectForm $form) {
                return $this->composerDependencies($form);
            });
        }
    }
}
