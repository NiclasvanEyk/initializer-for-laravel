<?php

namespace InitializerForLaravel\Core\Configuration;

use Illuminate\Http\Request;
use function in_array;

readonly final class Configurator
{
    public function __construct(private Definition $definition)
    {
    }

    /**
     * @param Request $request
     * @return Configuration
     */
    public function buildFrom(Request $request): Configuration
    {
        $choices = [];
        $includedChoices = $request->get("choices");
        foreach ($this->definition->choices as $choice) {
            $choices[$choice->name] = array_key_exists($choice->name, $includedChoices)
                ? $choice->enum::from($includedChoices[$choice->name])
                : $choice->default;
        }

        $options = [];
        $includedOptions = $request->get('options', []);
        foreach ($this->definition->options as $option) {
            $explicitlyIncluded = in_array($option->name, $includedOptions);
            $implicitlyIncluded = $option->includedByDefault;

            if ($explicitlyIncluded || $implicitlyIncluded) {
                $options[] = $option->name;
            }
        }

        return new Configuration($choices, $options);
    }
}
