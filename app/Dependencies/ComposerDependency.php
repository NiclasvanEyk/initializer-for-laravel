<?php


namespace App\Dependencies;


abstract class ComposerDependency
{
    /**
     * A unique identifier for the package.
     */
    abstract function id(): string;

    /**
     * The human readable name for the package.
     */
    abstract function name(): string;

    /**
     * An optional description of what the package does or what it can be
     * useful for.
     */
    abstract function description(): string;

    /**
     * An optional link to the documentation or the website of the package.
     */
    abstract public function href(): ?string;
}
