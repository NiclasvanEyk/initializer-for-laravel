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
     * @return Collection<int, ArchiveManipulator>
     *
     * @throws MissingArchiveManipulatorInterfaceException
     */
    public function resolve(): Collection
    {
        /** @var array<int, mixed> $manipulators */
        $manipulators = $this->container->tagged(ArchiveManipulator::class);

        return collect($manipulators)->each(function ($class) {
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
