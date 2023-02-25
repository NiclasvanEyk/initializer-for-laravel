<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;

class Configuration
{
    /**
     * @param  array<int,string>  $options
     * @param  array<string,BackedEnum>  $choices
     */
    public function __construct(
        public readonly array $choices,
        public readonly array $options,
    ) {
    }

    public function has(string $option): bool
    {
        return in_array($option, $this->options, strict: true);
    }

    public function choice(string $choice): BackedEnum
    {
        return $this->choices[$choice];
    }
}
