<?php

namespace App\Initializer\Configuration;

use BackedEnum;
use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Configuration\Dependency;
use App\Initializer\Configuration\Sail\Service;
use InitializerForLaravel\Core\Configuration\SimpleDataClass;
use InitializerForLaravel\Core\Project\Readme\Link;
use InitializerForLaravel\Core\View\Tag;
use function explode;
use function strtolower;

readonly final class Option
{
    use SimpleDataClass;

    /**
     * @param Dependency[] $dependencies
     * @param string[] $tags
     * @param array $setup
     * @param Link|null $readmeLink
     */
    public function __construct(
        public string       $id,
        public string       $name,
        public string       $description,
        public ?string      $link = null,
        public array        $dependencies = [],
        public array        $tags = [],
        public array        $setup = [],
        public ?Link        $readmeLink = null,
    ) {
    }

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
        ?Link $readmeLink = null
    ): self
    {
        $package = strtolower($option->name);
        $dependencies = [
            Dependency::composer("laravel/$package"),
        ];

        if ($sail) {
            $dependencies[] = $sail;
        }

        return new self(
            $option->value,
            // Usually the Laravel services use single-word names
            name: $option->name,
            description: $description,
            link: "https://laravel.com/docs/$package",
            dependencies: $dependencies,
            setup: $setup,
            readmeLink: $readmeLink
        );
    }

    public static function composer(
        string|Dependency $package,
        string $name,
        string $description,
        ?string $id = null,
        array  $options = [],
    ): self {
        $id ??= $package instanceof Dependency
            ? explode('/', $package->id)[1]
            : explode('/', $package)[1];

        return new self(
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
    ): self
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

        return new self(
            id: $service->value,
            name: $name,
            description: $description,
            link: $link,
            dependencies: $dependencies,
            tags: $tags,
        );
    }
}
