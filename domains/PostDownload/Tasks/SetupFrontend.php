<?php

namespace Domains\PostDownload\Tasks;

use Domains\NodeJs\NpmDependency;
use Domains\PostDownload\PostDownloadTaskGroup;
use Illuminate\Support\Collection;

class SetupFrontend implements PostDownloadTaskGroup
{
    /**
     * @param string $npm
     * @param Collection<int, NpmDependency> $packagesToInstall
     */
    public function __construct(
        private string $npm,
        private Collection $packagesToInstall,
    ) {
    }

    public function title(): string
    {
        return 'Setup frontend';
    }

    public function tasks(): array
    {
        $packages = $this->packagesToInstall
            ->map(fn (NpmDependency $package) => $package->packageId())
            ->implode(' ');

        return [
            "$this->npm install $packages",
            "$this->npm run dev",
        ];
    }
}
