<?php

namespace InitializerForLaravel\Core\Configuration;

use InitializerForLaravel\Core\Contracts\Option;

readonly final class Section
{
    use SimpleDataClass;

    /**
     * @param array<int,Option|Paragraph|Choice> $children
     */
    public function __construct(
        public string $name,
        public ?string $icon,
        public string $description,
        public array $children,
    ) {
    }
}
