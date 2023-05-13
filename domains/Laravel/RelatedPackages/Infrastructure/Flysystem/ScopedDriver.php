<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class ScopedDriver extends ComposerDependency
{
    public function id() : string
    {
        return 'flysystem-scoped';
    }

    public function packageId() : string
    {
        return 'league/flysystem-path-prefixing';
    }

    public function name() : string
    {
        return 'Scoped';
    }

    public function description() : string
    {
        return 'Allows you to define a filesystem where all paths are automatically prefixed with a given path prefix.';
    }

    public function href() : ?string
    {
        return 'https://laravel.com/docs/filesystem#scoped-and-read-only-filesystems';
    }

    public function versionConstraint() : ?string
    {
        return '^3.0';
    }
}