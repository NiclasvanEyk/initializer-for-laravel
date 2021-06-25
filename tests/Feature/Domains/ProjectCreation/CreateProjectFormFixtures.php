<?php

namespace Tests\Feature\Domains\ProjectCreation;

use Dflydev\DotAccessData\Data;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Scout\MeiliSearchScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\Sail\MySQLDatabase;
use Domains\Laravel\StarterKit\Laravel;

class CreateProjectFormFixtures
{
    public static function allOptionsEnabled(
        ?Metadata         $metadata = null,
        ?Authentication   $authentication = null,
        ?Database         $database = null,
        ?Cache            $cache = null,
        ?Queue            $queue = null,
        ?Search           $search = null,
        ?DevelopmentTools $developmentTools = null,
        ?Testing          $testing = null,
        ?Payment          $payment = null,
        ?Storage          $storage = null,
    ): CreateProjectForm
    {
        return new CreateProjectForm(
            $metadata ?? self::metadata(),
            $authentication ?? self::authentication(),
            $database ?? self::database(),
            $cache ?? self::cache(),
            $queue ?? self::queue(),
            $search ?? self::search(),
            $developmentTools ?? self::developmentTools(),
            $testing ?? self::testing(),
            $payment ?? self::payment(),
            $storage ?? self::storage(),
        );
    }

    public static function metadata(): Metadata
    {
        return new Metadata(
            vendorName: "foo",
            projectName: "bar",
            description: "", phpVersion: Metadata\PhpVersion::v8_0,
        );
    }

    public static function authentication(): Authentication
    {
        return new Authentication(
            starterKit: new Laravel(),
            usesFortify: true,
            usesPassport: true,
            usesSocialite: true,
        );
    }

    public static function database(): Database
    {
        return new Database(database: new MySQLDatabase());
    }

    public static function cache(): Cache
    {
        return new Cache(driver: new RedisCacheDriver());
    }

    public static function queue(): Queue
    {
        return new Queue(driver: new RedisQueueDriver(), usesHorizon: true);
    }

    public static function search(): Search
    {
        return new Search(driver: new MeiliSearchScoutDriver());
    }

    public static function developmentTools(): DevelopmentTools
    {
        return new DevelopmentTools(
            usesTelescope: true,
            usesMailhog: true,
            usesEnvoy: true,
        );
    }

    public static function testing(): Testing
    {
        return new Testing(usesDusk: true, usesPest: true);
    }

    public static function payment(): Payment
    {
        return new Payment(
            usesPaddle: true,
            usesStripe: true,
            usesMollie: true,
        );
    }

    public static function storage(): Storage
    {
        return new Storage(
            usesMinIO: true,
            usesSftp: true,
            usesCachedAdapter: true,
            usesS3: true,
        );
    }
}
