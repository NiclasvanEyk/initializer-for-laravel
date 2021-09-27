<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption as DatabaseOptionAlias;

class PostgresDatabase extends SailConfigurationOption implements DatabaseOption
{
    const REPOSITORY_KEY = DatabaseOptionAlias::POSTGRES;

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'PostgreSQL';
    }

    public function description(): string
    {
        return 'Extensible and open-source database.';
    }

    public function href(): string
    {
        return 'https://www.postgresql.org';
    }

    public function logo(): Logo
    {
        return new Logo(
            '/img/logos/database/postgres.svg',
            'Lines depicting an elephant (Postgres Logo)',
        );
    }

    public function sailId(): string
    {
        return 'pgsql';
    }
}
