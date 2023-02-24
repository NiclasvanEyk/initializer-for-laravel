<?php

namespace App\Initializer\TemplateStorage;

use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Contracts\TemplateDownloader;
use InitializerForLaravel\Packagist\DownloadedPackage;
use InitializerForLaravel\Packagist\Models\Package;
use InitializerForLaravel\Packagist\PackagistApiClient;
use PhpZip\ZipFile;

class LaravelProjectDownloader implements TemplateDownloader
{
    public function __construct(
        private PackagistApiClient $packagistApiClient,
    ) {
    }

    /**
     * @return Package[]
     */
    public function all(): array
    {
        return $this->packagistApiClient->packageReleases(
            'laravel',
            'laravel',
        );
    }

    public function latest(): Package
    {
        return $this->all()[0];
    }

    public function download(Package $package): DownloadedPackage
    {
        Log::info("Downloading $package->version from {$package->dist->url}...");

        $response = $this->packagistApiClient->downloadPackageDist($package)->body();

        // The archives contain a folder called `laravel-laravel-somehash`,
        // so we need to extract and re-zip the contents of that folder
        $downloadedArchive = (new ZipFile())->openFromString($response);

        $release = new DownloadedPackage(
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
