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
