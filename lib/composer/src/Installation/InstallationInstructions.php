<?php

namespace InitializerForLaravel\Composer\Installation;

readonly final class InstallationInstructions
{
    public function __construct(
        public string $package,
        public ?string $versionConstraint,
        public bool $isDevDependency = false,
    ) {
    }
}
