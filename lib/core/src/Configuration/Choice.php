<?php

namespace InitializerForLaravel\Core\Configuration;

readonly final class Choice
{
    use SimpleDataClass;

    /**
     * @param non-empty-array<int,Option> $options
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $link,
        public array $options,
        public bool $includesNone = false,
    ) {
    }
}
