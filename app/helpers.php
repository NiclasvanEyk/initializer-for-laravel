<?php

if (! function_exists('checkbox_checked')) {
    function checkbox_checked(string $parameter, bool $default = false): bool
    {
        $actualDefault = request()->has('no-defaults') ? false : $default;

        return old($parameter, request()->has($parameter) ?? $actualDefault);
    }
}
