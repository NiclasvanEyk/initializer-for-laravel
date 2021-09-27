<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption as DatabaseOptionAlias;

class MariaDatabase extends SailConfigurationOption implements DatabaseOption
{
    const REPOSITORY_KEY = DatabaseOptionAlias::MARIA_DB;

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'MariaDB';
    }

    public function description(): string
    {
        return 'Popular drop-in replacement for MySQL.';
    }

    public function href(): string
    {
        return 'https://mariadb.org';
    }

    public function logo(): Logo
    {
        return new Logo(
            '/img/logos/database/mariadb.svg',
            'Lines depicting a seal (MariaDB Logo)',
        );
    }

    public function sailId(): string
    {
        return 'mariadb';
    }
}
