<?php

namespace App\Initializer\Configuration;

use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Sail\Service;

readonly final class Sail
{
    const PACKAGE_MANAGER = 'sail';

    public static function service(Service $service): Dependency
    {
        return new Dependency(self::PACKAGE_MANAGER, $service->value);
    }
}
