<?php

namespace Domains\Laravel\NpmPackages;

use Domains\NodeJs\NpmDependency;

class LaravelEcho extends NpmDependency
{
    public function id(): string
    {
        return 'laravel-echo';
    }

    public function packageId(): string
    {
        return 'laravel-echo';
    }

    public function name(): string
    {
        return 'Laravel Echo';
    }

    public function description(): string
    {
        return '';
    }

    public function href(): string
    {
        return '';
    }
}
