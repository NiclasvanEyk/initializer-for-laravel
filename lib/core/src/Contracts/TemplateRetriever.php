<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Packagist\DownloadedPackage;
use InitializerForLaravel\Packagist\Package;

interface TemplateRetriever
{
    public function latest(): Package;

    public function download(Package $package): DownloadedPackage;
}
