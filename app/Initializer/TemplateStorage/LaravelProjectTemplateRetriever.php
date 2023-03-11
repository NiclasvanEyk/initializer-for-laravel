<?php

namespace App\Initializer\TemplateStorage;

use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Contracts\TemplateRetriever;
use InitializerForLaravel\Core\Storage\Template;
use InitializerForLaravel\Packagist\DownloadedPackage;
use InitializerForLaravel\Packagist\Package;
use InitializerForLaravel\Packagist\PackagistApiClient;
use PhpZip\ZipFile;

class LaravelProjectTemplateRetriever implements TemplateRetriever
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

    public function latest(): Template
    {
        $latestPackage = $this->all()[0];

        return new Template(
            url: $latestPackage->url,
            version: $latestPackage->version,
        );
    }

    public function fetch(Template $template): ZipFile
    {
        Log::info("Downloading $template->version from $template->url...");

        $response = $this->packagistApiClient->downloadPackageDist($template)->body();

        // The archives contain a folder called `laravel-laravel-somehash`,
        // so we need to extract and re-zip the contents of that folder
        $downloadedArchive = (new ZipFile())->openFromString($response);

        Log::info("$template->version successfully downloaded!");

        return $this->normalizedArchive($downloadedArchive);
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
