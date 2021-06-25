<?php

namespace Domains\CreateProjectForm\Sections\Database;

use Domains\Support\Enum\EmulatesEnum;

class DatabaseOption
{
    use EmulatesEnum;

    public const POSTGRES = 'postgres';
    public const MARIA_DB = 'mariadb';
    public const MY_SQL = 'mysql';

    public static function default()
    {
        return self::MY_SQL;
    }
}
