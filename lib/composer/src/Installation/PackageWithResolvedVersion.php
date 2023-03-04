<?php

namespace InitializerForLaravel\Composer\Installation;

use InitializerForLaravel\Composer\ComposerDependency;

/** @psalm-immutable */
class PackageWithResolvedVersion
{
    public function __construct(
        public ComposerDependency $package,
        public string $version,
    ) {
    }
}
