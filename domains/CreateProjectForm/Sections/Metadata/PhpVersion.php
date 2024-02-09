<?php

namespace Domains\CreateProjectForm\Sections\Metadata;

use Domains\Support\Enum\EmulatesEnum;

class PhpVersion
{
    use EmulatesEnum;

    public const v8_1 = '8.1';
    public const v8_2 = '8.2';
    public const v8_3 = '8.3';

    public static function latest(): string
    {
        return self::v8_3;
    }

    public static function preview(): ?string
    {
        return null;
    }
}
