<?php

namespace App\Initializer\Configuration;

use BackedEnum;
use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Configuration\Option as ConfigurationOption;
use InitializerForLaravel\Core\Sail\Service;
use InitializerForLaravel\Core\View\Tag;
use function explode;
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
        ?Dependency $sail = null,
        array $setup = [],
    ): ConfigurationOption
    {
        $package = strtolower($option->name);
        $dependencies = [
            Dependency::composer("laravel/$package"),
        ];

        if ($sail) {
            $dependencies[] = $sail;
        }

        return new ConfigurationOption(
            $option->value,
            // Usually the Laravel services use single-word names
            name: $option->name,
            description: $description,
            link: "https://laravel.com/docs/$package",
            dependencies: $dependencies,
            setup: $setup
        );
    }

    public static function composer(
        string|Dependency $package,
        string $name,
        string $description,
        ?string $id,
        array  $options = [],
    ): ConfigurationOption {
        $id ??= $package instanceof Dependency
            ? explode('/', $package->id)[0]
            : explode('/', $package)[0];

        return new ConfigurationOption(
            id: $id,
            name: $name,
            description: $description,
            dependencies: [
                $package instanceof Dependency
                    ? $package
                    : Dependency::composer($package, $options)
            ]
        );
    }

    public static function sail(
        Service $service,
        string $description,
        string $link,
        ?string $name = null,
        bool $isMaintainedByCommunity = false,
        array $composer = [],
    ): ConfigurationOption
    {
        $name ??= $service->name;

        $tags = [Tag::HasSailService->value];
        if ($isMaintainedByCommunity) {
            $tags[] = Tag::CommunityMaintained->value;
        }

        $dependencies = [Sail::service($service)];
        foreach ($composer as $package) {
            $dependencies[] = $package;
        }

        return new ConfigurationOption(
            id: $service->value,
            name: $name,
            description: $description,
            link: $link,
            dependencies: $dependencies,
            tags: $tags,
        );
    }
}
