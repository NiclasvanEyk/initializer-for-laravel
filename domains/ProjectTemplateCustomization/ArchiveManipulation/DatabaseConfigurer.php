<?php

namespace Domains\ProjectTemplateCustomization\ArchiveManipulation;

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
class DatabaseConfigurer
{
    /**
     * @var array<class-string, string>
     */
    private array $databaseToServiceMap = [
        PostgresDatabase::class => 'pgsql',
        MySQLDatabase::class => 'mysql',
        MariaDatabase::class => 'mariadb',
    ];

    public function adjustDefaults(
        ZipFile $archive,
        SailConfigurationOption|DatabaseOption $database,
    ): void {
        $service = $this->databaseToServiceMap[get_class($database)];

        $this->adjustConfig($archive, $service);
        $this->adjustExampleEnv($archive, $service);
    }

    private function adjustConfig(ZipFile $archive, string $service): void
    {
        $contents = $archive->getEntryContents('config/database.php');

        $archive->addFromString('config/database.php', Str::replaceFirst(
            "'default' => env('DB_CONNECTION', 'mysql'),",
            "'default' => env('DB_CONNECTION', '$service'),",
            $contents,
        ));
    }

    private function adjustExampleEnv(ZipFile $archive, string $service): void
    {
        $contents = $archive->getEntryContents('.env.example');

        $archive->addFromString('.env.example', Str::replaceFirst(
            "DB_CONNECTION=mysql",
            "DB_CONNECTION=$service",
            $contents,
        ));
    }
}
