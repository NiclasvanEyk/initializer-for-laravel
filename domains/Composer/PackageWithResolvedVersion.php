<?php

namespace Domains\Composer;

/** @psalm-immutable */
class PackageWithResolvedVersion
{
    public function __construct(
        public ComposerDependency $package,
        public string $version,
    ) {
    }
}
