<?php

namespace InitializerForLaravel\Core\Tests\Support;

enum Database: string
{
    case MySql = 'mysql';
    case Postgres = 'postgres';
    case Sqlite = 'sqlite';
}
