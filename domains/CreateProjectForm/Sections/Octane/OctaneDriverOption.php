<?php

namespace Domains\CreateProjectForm\Sections\Octane;

use Domains\Support\Enum\EmulatesEnum;

class OctaneDriverOption
{
    use EmulatesEnum;

    const NONE = 'none';
    const SWOOLE = 'swoole';
    const ROAD_RUNNER = 'roadrunner';

    public static function default(): string
    {
        return self::NONE;
    }
}
