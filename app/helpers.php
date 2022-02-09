<?php

if (! function_exists('checkbox_checked')) {
    function checkbox_checked(string $parameter, bool $default = false): bool
    {
        $fallback = request()->has('preset') ? false : $default;

        return old($parameter, request()->has($parameter) || $fallback);
    }
}

if (! function_exists('option_selected')) {
    function option_selected(string $parameter, mixed $default): mixed
    {
        $fallback = request()->has('preset') ? 'none' : $default;
        $default = request()->has($parameter) ? request($parameter) : $fallback;

        return old($parameter, $default);
    }
}

if (! function_exists('enum_option_selected')) {
    /**
     * @template E of BackedEnum
     *
     * @param  string  $parameter
     * @param  E  $default
     * @return E
     */
    function enum_option_selected(string $parameter, BackedEnum $default): BackedEnum
    {
        $fallback = request()->has('preset')
            ? $default::tryFrom('none')
            : $default;

        $value = request()->has($parameter)
            ? request($parameter)
            : old($parameter);

        return $fallback::tryFrom($value) ?? $fallback;
    }
}
