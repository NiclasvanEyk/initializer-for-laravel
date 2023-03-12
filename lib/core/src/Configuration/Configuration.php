<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;
use InitializerForLaravel\Core\Contracts\Option;
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

    /**
     * Returns the chosen {@link Option}s from the available sections.
     *
     * @template T The class implementing {@link Option}.
     * @param Section[] $sections
     * @return T[]
     * @throws UnknownChoice
     */
    public function evaluate(array $sections): array
    {
        $options = [];
        foreach ($sections as $section) {
            foreach ($section->children as $child) {
                if ($child instanceof Option && $this->has($child->id())) {
                    $options[] = $child;
                }

                if ($child instanceof Choice) {
                    $chosen = $this->choice($child->id);
                    foreach ($child->options as $option) {
                        if ($option->id() === $chosen->value) {
                            $options[] = $option;
                            break;
                        }
                    }
                    // TODO: What if an option for $chosen can not be found?
                }
            }
        }

        return $options;
    }
}
