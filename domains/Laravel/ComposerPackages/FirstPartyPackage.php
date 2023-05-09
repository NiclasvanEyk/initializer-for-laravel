<?php

namespace Domains\Laravel\ComposerPackages;

use Domains\Composer\ComposerDependency;
use Illuminate\Support\Str;

use function class_basename;

abstract class FirstPartyPackage extends ComposerDependency
{
    public function id(): string
    {
        return $this->packageId();
    }

    public function packageId(): string
    {
        $package = defined('static::REPOSITORY_KEY')
            ? static::REPOSITORY_KEY
            : $this->packageName();

        return "laravel/$package";
    }

    public function packageName(): string
    {
        return Str::lower(class_basename(static::class));
    }

    public function name(): string
    {
        return Str::ucfirst($this->packageName());
    }

    public function href(): string
    {
        return self::laravelDocsHref($this->packageName());
    }

    public static function laravelDocsHref(string $path): string
    {
        return "https://laravel.com/docs/$path";
    }
}
