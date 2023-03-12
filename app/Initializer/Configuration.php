<?php

namespace App\Initializer;

use InitializerForLaravel\Core\Configuration\Configuration as SelectedConfiguration;
use InitializerForLaravel\Core\Configuration\Section;
use InitializerForLaravel\Core\Configuration\Choice;
use InitializerForLaravel\Core\Contracts\Option;

readonly final class Configuration
{
    /**
     * @return Section[]
     */
    public static function sections(): array
    {
        return config('initializer-for-laravel.sections');
    }
}
