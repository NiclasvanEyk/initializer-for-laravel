<?php

namespace Domains\Platform\DependencyResolver;

use Domains\CreateProjectForm\CreateProjectForm;
use Illuminate\Support\Collection;

/**
 * @template ToResolve
 */
abstract class DependencyResolverContainer
{
    /**
     * @var callable[]
     * @psalm-var array<callable(CreateProjectForm): Collection<int, ToResolve>>
     */
    private array $resolvers = [];

    /**
     * Actually triggers the resolving process for all dependencies.
     *
     * This is intentionally "hidden" as the invoke method, so that it does
     * not appear in the regular auto-complete list, since this method will
     * likely only be called in platform code.
     *
     * @param CreateProjectForm $form The values of the form.
     * @return Collection<ToResolve>
     */
    public function __invoke(CreateProjectForm $form): Collection
    {
        $resolved = new Collection();

        foreach ($this->resolvers as $resolver) {
            $resolved = $resolved->merge($resolver($form));
        }

        return $resolved;
    }

    /**
     * Registers a new way of resolving packages.
     *
     * @param callable $resolver
     * @psalm-param callable(CreateProjectForm): Collection<int, ToResolve> $resolver
     */
    public function register(callable $resolver): self
    {
        $this->resolvers[] = $resolver;

        return $this;
    }
}
