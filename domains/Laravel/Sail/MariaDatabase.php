<?php


namespace Domains\Laravel\Sail;


use Domains\CreateProjectForm\Components\Logo;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption as DatabaseOptionAlias;

class MariaDatabase extends SailConfigurationOption implements DatabaseOption
{
    const REPOSITORY_KEY = DatabaseOptionAlias::MARIA_DB;

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'MariaDB';
    }

    function description(): string
    {
        return 'Popular drop-in replacement for MySQL.';
    }

    public function href(): string
    {
        return 'https://mariadb.org';
    }

    function logo(): Logo
    {
        return new Logo(
            '/img/logos/database/mariadb.svg',
            'Lines depicting a seal (MariaDB Logo)',
        );
    }

    function sailId(): string
    {
        return 'mariadb';
    }
}
