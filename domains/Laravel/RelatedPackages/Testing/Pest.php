<?php

namespace Domains\Laravel\RelatedPackages\Testing;

use InitializerForLaravel\Composer\ComposerDependency;

class Pest extends ComposerDependency
{
    public function isDevDependency(): bool
    {
        return true;
    }

    public function id(): string
    {
        return $this->packageId();
    }

    public function packageId(): string
    {
        return 'pestphp/pest-plugin-laravel';
    }

    public function name(): string
    {
        return 'Pest';
    }

    public function description(): string
    {
        return 'A Testing Framework with a focus on simplicity.';
    }

    public function href(): ?string
    {
        return 'https://pestphp.com';
    }
}
