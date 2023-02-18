<?php

namespace InitializerForLaravel\Core\View\Model;

use BackedEnum;
use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Sail\Service;
use View\Tag;

class Option
{
    /**
     * @param string[] $composer
     * @param string[] $npm
     * @param string|PostDownloadTask[] $setup
     */
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
        public readonly ?string $link = null,
        public readonly array|string $composer = [],
        public readonly array|string $npm = [],
        public readonly ?Service $service = null,
        public readonly bool $fromCommunity = false,
        public readonly array $setup = [],
    ) {
    }

    /**
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
            composer: "laravel/$package",
            setup: $setup
        );
    }
}
