<?php

namespace InitializerForLaravel\Composer;

enum PhpVersion: string
{
    case v8_1 = '8.1';
    case v8_2 = '8.2';

    public static function latest(): self
    {
        return self::v8_2;
    }

    public static function preview(): ?self
    {
        return null;
    }
}
