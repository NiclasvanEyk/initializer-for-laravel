<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption as DatabaseOptionAlias;

class MySQLDatabase extends SailConfigurationOption implements DatabaseOption
{
    const REPOSITORY_KEY = DatabaseOptionAlias::MY_SQL;

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'MySQL';
    }

    function description(): string
    {
        return 'The default database for Laravel applications.';
    }

    public function href(): string
    {
        return 'https://www.mysql.com';
    }

    function logo(): Logo
    {
        return new Logo(
            '/img/logos/database/mysql.svg',
            'Lines depicting a dolphin (MySQL Logo)',
        );
    }

    function sailId(): string
    {
        return 'mysql';
    }
}
