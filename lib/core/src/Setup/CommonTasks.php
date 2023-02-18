<?php

namespace InitializerForLaravel\Core\Setup;

class CommonTasks
{
    public static function artisan(string $command): string
    {
        return "php artisan $command --no-interaction";
    }

    public static function publishConfigFile(string $provider): string
    {
        return self::artisan("vendor:publish --provider=\"$provider\"");
    }

    public static function migrateDatabase(): string
    {
        return self::artisan('migrate');
    }
}
