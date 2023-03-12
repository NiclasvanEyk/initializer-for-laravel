<?php

namespace InitializerForLaravel\Composer\Initializer;

use InitializerForLaravel\Composer\PhpVersion;

readonly final class ComposerPackageMetadata
{
    public function __construct(
        public string $vendorName,
        public string $projectName,
        public string $description = '',
        public PhpVersion $phpVersion = PhpVersion::v8_1,
    ) {
    }

    public function fullName(): string
    {
        return "$this->vendorName/$this->projectName";
    }
}
