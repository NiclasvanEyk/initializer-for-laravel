<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Octane\OctaneDriver;
use Domains\CreateProjectForm\Sections\Octane\OctaneDriverOption;
use Domains\CreateProjectForm\Sections\Octane\RoadRunnerOctaneDriver;
use Domains\CreateProjectForm\Sections\Octane\SwooleOctaneDriver;

class Octane
{
    public function __construct(public ?OctaneDriver $driver)
    {
    }

    public static function driverForOption(string $option): ?OctaneDriver
    {
        return match ($option) {
            OctaneDriverOption::SWOOLE => new SwooleOctaneDriver(),
            OctaneDriverOption::ROAD_RUNNER => new RoadRunnerOctaneDriver(),
            OctaneDriverOption::NONE => null,
            default => null,
        };
    }
}
