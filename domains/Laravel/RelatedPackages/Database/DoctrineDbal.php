<?php

namespace Domains\Laravel\RelatedPackages\Database;

use InitializerForLaravel\Composer\ComposerDependency;

class DoctrineDbal extends ComposerDependency
{
    public function id(): string
    {
        return 'doctrine-dbal';
    }

    public function packageId(): string
    {
        return 'doctrine/dbal';
    }

    public function name(): string
    {
        return 'Doctrine DBAL';
    }

    public function description(): string
    {
        return 'Advanced database schema introspection and schema management.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/migrations#prerequisites';
    }
}
