<?php

namespace InitializerForLaravel\Core\Configuration;

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
