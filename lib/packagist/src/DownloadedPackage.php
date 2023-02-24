<?php

namespace InitializerForLaravel\Packagist;

use InitializerForLaravel\Packagist\Models\Package;
use PhpZip\ZipFile;

readonly class DownloadedPackage
{
    public function __construct(
        public Package $package,
        public ZipFile $archive,
    ) {
    }
}
