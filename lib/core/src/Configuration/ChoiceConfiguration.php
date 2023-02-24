<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;

/**
 * @template T extends \BackedEnum
 */
readonly class ChoiceConfiguration
{
    /**
     * @param class-string<T> $enum
     * @param T $default
     */
    public function __construct(
        public string $enum,
        public BackedEnum $default,
    )
    {
    }
}
