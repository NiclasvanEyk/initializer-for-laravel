<?php

namespace Domains\Platform;

use Domains\Platform\DependencyResolver\Concrete\ComposerDependencyResolver;
use Domains\Platform\DependencyResolver\Concrete\NpmDependencyResolver;
use Domains\Platform\DependencyResolver\Concrete\SailServiceResolver;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ComposerDependencyResolver::class);
        $this->app->singleton(NpmDependencyResolver::class);
        $this->app->singleton(SailServiceResolver::class);
    }
}
