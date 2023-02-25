<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Packagist\DownloadedPackage;
use InitializerForLaravel\Packagist\Models\Package;

interface TemplateDownloader
{
    public function latest(): Package;

    public function download(Package $package): DownloadedPackage;
}
