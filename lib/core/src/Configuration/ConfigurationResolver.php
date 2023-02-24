<?php

namespace InitializerForLaravel\Core\Configuration;

use Illuminate\Http\Request;

readonly final class ConfigurationResolver
{
    /**
     * @param string[] $availableOptions
     * @param ChoiceConfiguration[] $availableChoices
     */
    public function __construct(
        private array $availableOptions,
        private array $availableChoices,
    ) {
    }

    /**
     * @param Request $request
     * @return Configuration
     */
    public function resolveFrom(
        Request $request,
    ): Configuration
    {
        $choices = [];
        $includedChoices = $request->get("choices");
        foreach ($this->availableChoices as $name => $availableChoice) {
            $choices[$name] = array_key_exists($name, $includedChoices)
                ? $availableChoice->enum::from($includedChoices[$name])
                : $availableChoice->default;
        }

        $chosenOptions = explode(",", $request->get("options", ""));
        $chosenOptions = array_intersect($chosenOptions, $this->availableOptions);

        return new Configuration($choices, $chosenOptions);
    }
}
