<?php

namespace InitializerForLaravel\Packagist\Models;

use Illuminate\Support\Arr;

/** @psalm-immutable */
class Package
{
    public function __construct(
        public string $name,
        public string $version,
        public PackageDist $dist,
    ) {
    }

    /**
     * @param  array<string, mixed>  $package
     */
    public static function fromResponse(array $package): self
    {
        return new self(
            name: Arr::get($package, 'name', 'unknown'),
            version: Arr::get($package, 'version', 'unknown'),
            dist: PackageDist::fromRequest(Arr::get($package, 'dist', [])),
        );
    }
}
