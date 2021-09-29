<?php

namespace Domains\ArchiveManipulation;

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
     * Resolves all {@link ArchiveManipulator} implementations from the container.
     *
     * @return ArchiveManipulator[]|Collection
     *
     * @throws MissingArchiveManipulatorInterfaceException
     */
    public function resolve(): Collection
    {
        return collect($this->container->tagged(ArchiveManipulator::class))
            ->each(function ($manipulator) {
                if (! class_implements($manipulator, ArchiveManipulator::class)) {
                    throw new MissingArchiveManipulatorInterfaceException(
                        $manipulator
                    );
                }
            });
    }
}
