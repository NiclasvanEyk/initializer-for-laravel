<?php

namespace Domains\CreateProjectForm\Sections\Metadata;

use Domains\Support\Enum\EmulatesEnum;

class PhpVersion
{
    use EmulatesEnum;

    public const v8_0 = '8.0';
    public const v8_1 = '8.1';
    public const v8_2 = '8.2';

    public static function latest(): string
    {
        return self::v8_1;
    }

    public static function preview(): string
    {
        return self::v8_2;
    }
}
