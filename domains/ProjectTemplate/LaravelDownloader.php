<?php

namespace Domains\ProjectTemplate;

use Domains\Packagist\Models\Package;
use Domains\Packagist\PackagistApiClient;
use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

class LaravelDownloader
{
    public function __construct(
        private PackagistApiClient $packagistApiClient,
    ) {
    }

    /**
     * @return Package[]
     */
    public function laravelReleases(): array
    {
        return $this->packagistApiClient->packageReleases(
            'laravel',
            'laravel',
        );
    }

    public function latestRelease(): Package
    {
        return $this->laravelReleases()[0];
    }

    public function download(Package $package): DownloadedLaravelRelease
    {
        Log::info("Downloading $package->version from {$package->dist->url}...");

        $response = $this->packagistApiClient->downloadPackageDist($package)->body();

        // The archives contain a folder called `laravel-laravel-somehash`,
        // so we need to extract and re-zip the contents of that folder
        $downloadedArchive = (new ZipFile())->openFromString($response);

        $release = new DownloadedLaravelRelease(
            package: $package,
            archive: $this->normalizedArchive($downloadedArchive),
        );

        Log::info("$package->version successfully downloaded!");

        return $release;
    }

    /** @codeCoverageIgnore */
    private function normalizedArchive(ZipFile $downloadedArchive): ZipFile
    {
        $targetFolder = Path::join(
            sys_get_temp_dir(),
            'initializer-for-laravel',
            'downloaded-templates',
            Str::uuid(),
        );
        File::ensureDirectoryExists($targetFolder);

        $downloadedArchive->extractTo($targetFolder);
        $folderName = $downloadedArchive->getListFiles()[0];

        return (new ZipFile())->addDirRecursive(
            Path::join($targetFolder, $folderName)
        );
    }
}
