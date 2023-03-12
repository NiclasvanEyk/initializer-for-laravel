<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;
use InitializerForLaravel\Core\Contracts\Option;

readonly final class Choice
{
    use SimpleDataClass;

    const NONE = 'none';

    /**
     * @param non-empty-array<int,Option> $options
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $link,
        public string|BackedEnum $default,
        public array $options,
        public bool $includesNone = true,
    ) {
    }
}
