<?php

namespace Tests\Feature\Domains\ProjectCreation;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;
use Domains\CreateProjectForm\Sections\Cashier\CashierStripeDriver;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\Database\DatabaseOption;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Scout\MeiliSearchScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\Sail\MySQLDatabase;
use Domains\Laravel\StarterKit\BreezeFrontend;
use Domains\Laravel\StarterKit\Laravel;
use Domains\Laravel\StarterKit\StarterKit;

class CreateProjectFormFixtures
{
    public static function allParameters()
    {
        return [
            /** @see Metadata */
            P::VENDOR => 'foo',
            P::PROJECT => 'bar',
            P::PHP => PhpVersion::v8_0,
            P::DESCRIPTION => '',

            /** @see Authentication */
            P::STARTER => StarterKit::BREEZE,
            // Does not make sense here, we use breeze
            //            P::USES_JETSTREAM_TEAMS => '',
            //            P::JETSTREAM_FRONTEND => '',
            P::BREEZE_FRONTEND => BreezeFrontend::BLADE,
            P::USES_FORTIFY => true,
            P::USES_PASSPORT => true,
            P::USES_SOCIALITE => true,

            /** @see Database */
            P::DATABASE => DatabaseOption::default(),

            /** @see Cache */
            P::CACHE_DRIVER => CacheOption::default(),

            /** @see Search */
            P::SCOUT_DRIVER => ScoutDriverOption::default(),

            /** @see Queue */
            P::QUEUE_DRIVER => QueueDriverOption::default(),
            P::USES_HORIZON => true,

            /** @see DevelopmentTools */
            P::USES_TELESCOPE => true,
            P::USES_MAILHOG => true,
            P::USES_ENVOY => true,

            /** @see Testing */
            P::USES_DUSK => true,
            P::USES_PEST => true,

            /** @see Payment */
            P::CASHIER_DRIVER => CashierDriverOption::STRIPE,

            /** @see Storage */
            P::USES_MINIO => true,
            P::USES_FLYSYSTEM_S3_DRIVER => true,
            P::USES_FLYSYSTEM_SFTP_DRIVER => true,
            P::USES_FLYSYSTEM_CACHED_ADAPTER => true,
        ];
    }

    public static function allOptionsEnabled(
        ?Metadata $metadata = null,
        ?Authentication $authentication = null,
        ?Database $database = null,
        ?Cache $cache = null,
        ?Queue $queue = null,
        ?Search $search = null,
        ?DevelopmentTools $developmentTools = null,
        ?Testing $testing = null,
        ?Payment $payment = null,
        ?Storage $storage = null,
    ): CreateProjectForm {
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
            vendorName: 'foo',
            projectName: 'bar',
            description: '', phpVersion: Metadata\PhpVersion::latest(),
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
        return new Payment(driver: new CashierStripeDriver);
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
