<?php

namespace App\Sail;

class PostgresDatabase extends SailConfigurationOption
{
    function id(): string
    {
        return 'database-postgres';
    }

    function name(): string
    {
        return 'PostgreSQL';
    }

    function description(): string
    {
        return 'Extensible and open-source database.';
    }

    public function href(): ?string
    {
        return 'https://www.postgresql.org';
    }
}
