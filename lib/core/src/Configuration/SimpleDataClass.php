<?php

namespace InitializerForLaravel\Core\Configuration;

/**
 * Can be used to enable usage in Laravel's configuration files.
 *
 * Requires the using class to be instantiable simply by passing its properties
 * through the constructor. Works best with simple (readonly) classes, where all
 * properties are defined through constructor property promotion.
 *
 * @internal
 */
trait SimpleDataClass
{
    public static function __set_state($attributes)
    {
        return new self(...$attributes);
    }
}
