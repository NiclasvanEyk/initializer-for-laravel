<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;
use InitializerForLaravel\Core\Exception\UnknownChoice;
use function array_key_exists;

readonly final class Configuration
{
    /**
     * @param array<int,string> $options
     * @param array<string,BackedEnum> $choices
     */
    public function __construct(public array $choices, public array $options)
    {
    }

    public function has(string $option): bool
    {
        return in_array($option, $this->options, strict: true);
    }

    public function choice(string $choice): BackedEnum
    {
        if (!array_key_exists($choice, $this->choices)) {
            throw new UnknownChoice($choice);
        }

        return $this->choices[$choice];
    }
}
