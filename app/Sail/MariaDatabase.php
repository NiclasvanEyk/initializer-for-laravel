<?php


namespace App\Sail;


class MariaDatabase extends SailConfigurationOption
{
    function id(): string
    {
        return 'database-maria';
    }

    function name(): string
    {
        return 'MariaDB';
    }

    function description(): string
    {
        return 'Popular drop-in replacement for MySQL.';
    }

    public function href(): ?string
    {
        return 'https://mariadb.org';
    }
}
