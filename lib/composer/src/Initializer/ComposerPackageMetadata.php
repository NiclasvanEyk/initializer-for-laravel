<?php

namespace InitializerForLaravel\Composer\Initializer;

use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;

readonly final class ComposerPackageMetadata
{
    public function __construct(
        public string $vendorName,
        public string $projectName,
        public string $description = '',
        public string $phpVersion = PhpVersion::v8_1,
    ) {
    }

    public function fullName(): string
    {
        return "$this->vendorName/$this->projectName";
    }
}
