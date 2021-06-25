<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption as DatabaseOptionAlias;

class PostgresDatabase extends SailConfigurationOption implements DatabaseOption
{
    const REPOSITORY_KEY = DatabaseOptionAlias::POSTGRES;

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'PostgreSQL';
    }

    function description(): string
    {
        return 'Extensible and open-source database.';
    }

    public function href(): string
    {
        return 'https://www.postgresql.org';
    }

    function logo(): Logo
    {
        return new Logo(
            '/img/logos/database/postgres.svg',
            'Lines depicting an elephant (Postgres Logo)',
        );
    }

    function sailId(): string
    {
        return 'pgsql';
    }
}
