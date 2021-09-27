<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class CachedAdapter extends ComposerDependency
{
    public function id(): string
    {
        return 'flysystem-cached';
    }

    public function packageId(): string
    {
        return 'league/flysystem-cached-adapter';
    }

    public function name(): string
    {
        return 'Cached Adapter';
    }

    public function description(): string
    {
        // Was inlined, to be able to use links
        return '';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/filesystem#caching';
    }

    public function versionConstraint(): ?string
    {
        return '~1.0';
    }
}
