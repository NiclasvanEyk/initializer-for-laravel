<?php

namespace App\Sail;

class MySQLDatabase extends SailConfigurationOption
{
    function id(): string
    {
        return 'database-mysql';
    }

    function name(): string
    {
        return 'MySQL';
    }

    function description(): string
    {
        return 'The default database for Laravel applications.';
    }

    public function href(): ?string
    {
        return 'https://www.mysql.com';
    }
}
