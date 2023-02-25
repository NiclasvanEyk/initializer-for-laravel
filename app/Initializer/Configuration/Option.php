<?php

namespace App\Initializer\Configuration;

use BackedEnum;
use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Configuration\Option as ConfigurationOption;
use function strtolower;

readonly final class Option
{
    /**
     * Builds an option representing a first party laravel package.
     *
     * @param string|PostDownloadTask[] $setup
     */
    public static function laravel(
        BackedEnum $option,
        string $description,
        array $setup = [],
    ): ConfigurationOption
    {
        $package = strtolower($option->name);

        return new ConfigurationOption(
            $option->value,
            // Usually the Laravel services use single-word names
            name: $option->name,
            description: $description,
            link: "https://laravel.com/docs/$package",
            dependencies: [Dependency::composer("laravel/$package")],
            setup: $setup
        );
    }

    public static function sailService()
    {

    }
}
