<?php

namespace App\Initializer\Configuration;

use InitializerForLaravel\Core\Configuration\Dependency;

readonly final class ComposerPackage
{
    public static function awsSdk(): Dependency
    {
        return Dependency::composer("aws/aws-sdk-php");
    }
}
