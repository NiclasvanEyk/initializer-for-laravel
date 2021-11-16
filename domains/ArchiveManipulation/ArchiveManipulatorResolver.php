<?php

namespace Domains\ArchiveManipulation;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Support\Collection;

/**
 * Resolves all {@link ArchiveManipulator} implementations from the container.
 *
 * @see RegistersArchiveManipulators Registers a new implementation
 */
class ArchiveManipulatorResolver
{
    public function __construct(private Container $container)
    {
    }

    /**
     * Resolves all {@link ArchiveManipulator} implementations from the
     * container.
     *
     * @return ArchiveManipulator[]|Collection
     *
     * @throws MissingArchiveManipulatorInterfaceException
     */
    public function resolve(): Collection
    {
        return collect($this->container->tagged(ArchiveManipulator::class))
            ->each(function ($class) {
                $this->ensureImplementsArchiveManipulatorInterface($class);
            });
    }

    private function ensureImplementsArchiveManipulatorInterface(
        mixed $class,
    ): void {
        if (! $class instanceof ArchiveManipulator) {
            throw new MissingArchiveManipulatorInterfaceException($class);
        }
    }
}
