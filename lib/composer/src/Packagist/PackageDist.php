<?php

namespace InitializerForLaravel\Composer\Packagist;

use Illuminate\Support\Arr;

/** @psalm-immutable */
class PackageDist
{
    public function __construct(
        public string $type,
        public string $url,
        public string $reference,
    ) {
    }

    /**
     * @param  array<string, mixed>  $dist
     */
    public static function fromRequest(array $dist): self
    {
        return new self(
            Arr::get($dist, 'type', ''),
            Arr::get($dist, 'url', ''),
            Arr::get($dist, 'reference', ''),
        );
    }
}
