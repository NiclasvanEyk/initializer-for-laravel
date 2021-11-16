<?php

namespace Domains\ArchiveManipulation;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

/**
 * Trait to add to a {@link ServiceProvider}, so one can easily register an
 * implementation of a {@link ArchiveManipulator} via the provided
 * {@link RegistersArchiveManipulators::registerArchiveManipulator()} method.
 *
 * This should be done in the {@link ServiceProvider::register()} method!
 *
 * @mixin ServiceProvider
 */
trait RegistersArchiveManipulators
{
    /**
     * @param class-string|class-string[] $manipulators
     */
    public function registerArchiveManipulator(string|array $manipulators): void
    {
        $this->app->tag(Arr::wrap($manipulators), ArchiveManipulator::class);
    }
}
