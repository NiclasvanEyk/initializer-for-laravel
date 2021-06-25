<?php

namespace Domains\Laravel\RelatedPackages\Community;

use Domains\Composer\ComposerDependency;

class Pest extends ComposerDependency
{
    public function isDevDependency(): bool
    {
        return true;
    }

    function id(): string
    {
        return $this->packageId();
    }

    function packageId(): string
    {
        return 'pestphp/pest-plugin-laravel';
    }

    function name(): string
    {
        return 'Pest';
    }

    function description(): string
    {
        return 'A Testing Framework with a focus on simplicity.';
    }

    public function href(): ?string
    {
        return 'https://pestphp.com';
    }
}
