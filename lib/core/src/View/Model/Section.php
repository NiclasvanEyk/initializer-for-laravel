<?php

namespace InitializerForLaravel\Core\View\Model;

class Section
{
    /**
     * @param array<int,Option|Paragraph|Choice> $children
     */
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly array $children,
    )
    {
    }
}
