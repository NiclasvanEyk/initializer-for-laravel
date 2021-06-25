<?php

namespace Domains\Support\Enum;

use ReflectionClass;
use ReflectionClassConstant as Constant;

/**
 * Classes that can be replaced once PHP 8.1 hits.
 */
trait EmulatesEnum
{
    public static function values(): array
    {
        $reflected = new ReflectionClass(self::class);
        $publicConstants = $reflected->getConstants(Constant::IS_PUBLIC);

        return $publicConstants;
    }
}
