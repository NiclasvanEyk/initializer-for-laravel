<?php

namespace InitializerForLaravel\Composer\Packagist;

use Illuminate\Http\Client\Factory as HttpClientFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use InitializerForLaravel\Packagist\Package;

class PackagistApiClient
{
    public function __construct(
        private HttpClientFactory $httpClientFactory,
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
        $response = $this->request()->get("$this->baseUrl/$vendor/$package.json");
        /** @var array<int, array<string, mixed>> $packages */
        $packages = $response->json("packages.$vendor/$package");

        return collect($packages)
            ->map(fn (array $package) => Package::fromResponse($package))
            ->all();
    }

    public function downloadPackageDist(Package $package): Response
    {
        return $this->request()->get($package->dist->url);
    }

    protected function request(): PendingRequest
    {
        return new PendingRequest($this->httpClientFactory);
    }
}
