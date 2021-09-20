<?php

namespace Domains\Laravel\ComposerPackages;

use Domains\Composer\ComposerDependency;
use Illuminate\Support\Str;
use function class_basename;

abstract class FirstPartyPackage extends ComposerDependency
{
    function id(): string
    {
        return $this->packageId();
    }

    function packageId(): string
    {
        $package = defined('static::REPOSITORY_KEY')
            // @phpstan-ignore-next-line
            ? static::REPOSITORY_KEY
            : $this->packageName();

        return "laravel/$package";
    }

    function packageName(): string
    {
        return Str::lower(class_basename(static::class));
    }

    function name(): string
    {
        return Str::ucfirst($this->packageName());
    }

    public function href(): string
    {
        return self::laravelDocsHref($this->packageName());
    }

    static function laravelDocsHref(string $path): string {
        return "https://laravel.com/docs/$path";
    }
}
