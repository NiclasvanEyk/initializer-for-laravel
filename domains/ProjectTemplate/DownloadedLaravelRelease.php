<?php

namespace Domains\ProjectTemplate;

use InitializerForLaravel\Packagist\Package;
use PhpZip\ZipFile;

/**
 * @psalm-immutable
 *
 * @codeCoverageIgnore
 */
class DownloadedLaravelRelease
{
    public function __construct(
        public Package $package,
        public ZipFile $archive,
    ) {
    }
}
