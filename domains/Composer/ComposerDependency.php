<?php

namespace Domains\Composer;

abstract class ComposerDependency
{
    /**
     * A unique identifier for the package.
     */
    abstract public function id(): string;

    /**
     * Name of the package when requiring using composer.
     */
    abstract public function packageId(): string;

    /**
     * The human readable name for the package.
     */
    abstract public function name(): string;

    /**
     * An optional description of what the package does or what it can be
     * useful for.
     */
    abstract public function description(): string;

    /**
     * An optional link to the documentation or the website of the package.
     */
    abstract public function href(): ?string;

    public function isDevDependency(): bool
    {
        return false;
    }

    /**
     * Adds the --with-all-dependencies flag when installing.
     */
    public function needsToBeInstalledWithAllDependencies(): bool
    {
        return false;
    }

    /**
     * Possible version constraint that needs to be enforced while installing.
     */
    public function versionConstraint(): ?string
    {
        return null;
    }

    public function constraintsVersion(): bool
    {
        return $this->versionConstraint() !== null;
    }
}
