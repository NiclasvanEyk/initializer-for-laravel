<?php

namespace InitializerForLaravel\Core\Configuration;

use BackedEnum;
use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Sail\Service;

readonly final class Option
{
    use SimpleDataClass;

    /**
     * @param string[] $tags
     * @param Dependency[] $dependencies
     * @param string|PostDownloadTask[] $setup
     */
    public function __construct(
        public string       $id,
        public string       $name,
        public string       $description,
        public ?string      $link = null,
        public array        $dependencies = [],
        public array        $tags = [],
        public array        $setup = [],
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
        array $setup = [],
    ): self {
        $package = strtolower($option->name);

        return new self(
            $option->value,
            // Usually the Laravel services use single-word names
            name: $option->name,
            description: $description,
            link: "https://laravel.com/docs/$package",
            dependencies: [Dependency::composer("laravel/$package")],
            setup: $setup
        );
    }
}
