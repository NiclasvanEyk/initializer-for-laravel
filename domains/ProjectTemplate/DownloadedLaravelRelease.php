<?php

namespace Domains\ProjectTemplate;

use Domains\Packagist\Models\Package;
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
