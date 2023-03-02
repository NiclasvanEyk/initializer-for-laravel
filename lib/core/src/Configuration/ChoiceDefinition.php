<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;

/**
 * @template T extends \BackedEnum
 */
readonly final class ChoiceDefinition
{
    /**
     * @param class-string<T> $enum
     * @param T $default
     */
    public function __construct(
        public string $name,
        public string $enum,
        public BackedEnum $default,
    ) {
    }
}
