<?php

namespace InitializerForLaravel\Core\View\Model;

class Section
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly array $children,
    )
    {
    }
}
