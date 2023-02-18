<?php

namespace InitializerForLaravel\Core\Sail;

enum Service: string
{
    case MariaDB = 'mariadb';
    case Mailpit = 'mailpit';
    case Meilisearch = 'meilisearch';
    case Memcached = 'memcached';
    case MinIO = 'minio';
    case MySQL = 'mysql';
    case PostgreSQL = 'pgsql';
    case Redis = 'redis';
    case Selenium = 'selenium';
    case Soketi = 'soketi';
}
