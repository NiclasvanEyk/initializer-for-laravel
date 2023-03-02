<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;
use function http_build_query;
use function implode;
use function sort;

readonly final class Serializer
{
    public function __construct()
    {
    }

    /**
     * Builds a standardized query string without the '?'.
     */
    public function queryString(Configuration $configuration): string
    {
        $options = [...$configuration->options];
        sort($options);

        $choices = array_map(
            fn (BackedEnum $choice) => $choice->value,
            $configuration->choices
        );
        ksort($choices);

        return http_build_query([
            ...$choices,
            'include' => implode(',', $options),
        ]);
    }
}
