<?php

namespace Domains\Laravel\Sail;

use InitializerForLaravel\Composer\ComposerDependency;

/**
 * Inspired by {@link ComposerDependency}.
 *
 * Maybe should be an interface.
 */
abstract class SailConfigurationOption
{
    /**
     * A unique identifier for the option.
     */
    abstract public function id(): string;

    /**
     * The human-readable name for the option.
     */
    abstract public function name(): string;

    /**
     * An optional description of what the option does or what it can be
     * useful for.
     */
    abstract public function description(): string;

    /**
     * An optional link to the documentation or the website of the option.
     */
    abstract public function href(): ?string;
}
