<?php

namespace InitializerForLaravel\Core\Configuration;

readonly final class OptionDefinition
{
    public function __construct(
        public string $name,
        public bool   $includedByDefault = false,
    ) {
    }
}
