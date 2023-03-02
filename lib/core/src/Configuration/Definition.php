<?php

namespace InitializerForLaravel\Core\Configuration;

readonly final class Definition
{
    /**
     * @param ChoiceDefinition[] $choices
     * @param OptionDefinition[] $options
     */
    public function __construct(
        public array $choices,
        public array $options,
    ) {
    }
}
