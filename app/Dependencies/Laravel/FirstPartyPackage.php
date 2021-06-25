<?php

namespace App\Dependencies\Laravel;

use App\Dependencies\ComposerDependency;
use Illuminate\Support\Str;

abstract class FirstPartyPackage extends ComposerDependency
{
    function id(): string
    {
        $packageName = Str::lower(class_basename(static::class));

        return "laravel/$packageName";
    }

    function name(): string
    {
        return Str::ucfirst(Str::replaceFirst('laravel/', '', $this->id()));
    }

    public function href(): string
    {
        return self::laravelDocsHref($this->id());
    }

    static function laravelDocsHref(string $path): string {
        return "https://laravel.com/docs/$path";
    }
}
