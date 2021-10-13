<?php

namespace Domains\ConfigAdjustment;

use Domains\Laravel\Sail\DatabaseOption;
use Domains\Laravel\Sail\MariaDatabase;
use Domains\Laravel\Sail\MySQLDatabase;
use Domains\Laravel\Sail\PostgresDatabase;
use Domains\Laravel\Sail\SailConfigurationOption;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

/**
 * Adjusts project configuration according to the used database.
 */
class DatabaseAdjuster
{
    /**
     * @var array<class-string, string>
     */
    private array $databaseToConnectionMap = [
        PostgresDatabase::class => 'pgsql',
        MySQLDatabase::class => 'mysql',
        MariaDatabase::class => 'mysql',
    ];

    public function adjustDefaults(
        ZipFile $archive,
        SailConfigurationOption|DatabaseOption $database,
    ): void {
        $connection = $this->databaseToConnectionMap[get_class($database)];

        $this->adjustConfig($archive, $connection);
        $this->adjustExampleEnv($archive, $connection);
    }

    private function adjustConfig(ZipFile $archive, string $connection): void
    {
        $contents = $archive->getEntryContents('config/database.php');

        $archive->addFromString('config/database.php', Str::replaceFirst(
            "'default' => env('DB_CONNECTION', 'mysql'),",
            "'default' => env('DB_CONNECTION', '$connection'),",
            $contents,
        ));
    }

    private function adjustExampleEnv(ZipFile $archive, string $connection): void
    {
        $contents = $archive->getEntryContents('.env.example');

        $archive->addFromString('.env.example', Str::replaceFirst(
            'DB_CONNECTION=mysql',
            "DB_CONNECTION=$connection",
            $contents,
        ));
    }
}
