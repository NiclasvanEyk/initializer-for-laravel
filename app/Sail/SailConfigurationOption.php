<?php

namespace App\Sail;

use App\Dependencies\ComposerDependency;

/**
 * Inspired by {@link ComposerDependency}
 */
abstract class SailConfigurationOption
{
    /**
     * A unique identifier for the option.
     */
    abstract function id(): string;

    /**
     * The human readable name for the option.
     */
    abstract function name(): string;

    /**
     * An optional description of what the option does or what it can be
     * useful for.
     */
    abstract function description(): string;

    /**
     * An optional link to the documentation or the website of the option.
     */
    abstract public function href(): ?string;
}
