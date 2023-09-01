<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class ReadonlyDriver extends ComposerDependency
{
    public function id(): string
    {
        return 'flysystem-readonly';
    }

    public function packageId(): string
    {
        return 'league/flysystem-read-only';
    }

    public function name(): string
    {
        return 'Read-Only';
    }

    public function description(): string
    {
        return 'Allows you to create filesystem disks that do not allow write operations.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/filesystem#scoped-and-read-only-filesystems';
    }

    public function versionConstraint(): ?string
    {
        return '^3.0';
    }
}
