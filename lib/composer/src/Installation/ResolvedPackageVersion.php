<?php

namespace InitializerForLaravel\Composer\Installation;

readonly final class ResolvedPackageVersion
{
    public function __construct(
        public string $package,
        public string $version,
        public bool $isDevDependency,
    ) {
    }
}
