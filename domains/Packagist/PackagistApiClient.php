<?php

namespace Domains\Packagist;

use Domains\Packagist\Models\Package;
use Illuminate\Support\Facades\Http;

class PackagistApiClient
{
    public function __construct(
        private string $baseUrl = 'https://repo.packagist.org/p2',
    ) {
    }

    /**
     * @param  string  $vendor
     * @param  string  $package
     * @return Package[]
     */
    public function packageReleases(string $vendor, string $package): array
    {
        $response = Http::get("$this->baseUrl/$vendor/$package.json");

        return collect($response->json("packages.$vendor/$package"))
            ->map(fn (array $package) => Package::fromResponse($package))
            ->all();
    }
}
