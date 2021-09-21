<?php

namespace Tests\Feature\Domains\ProjectCreation\Http\Request;

use Domains\CreateProjectForm\Http\Request\{
    CreateProjectRequest,
    CreateProjectRequest\CreateProjectRequestParameter as P,
};
use Domains\CreateProjectForm\Sections\{
    Cache\CacheOption,
    Cache\RedisCacheDriver,
    Cashier\CashierDriverOption,
    Cashier\CashierStripeDriver,
    Database\DatabaseOption,
    Metadata\PhpVersion,
    Queue\QueueDriverOption,
    Scout\MeiliSearchScoutDriver,
    Scout\ScoutDriverOption
};
use Domains\Laravel\Sail\MySQLDatabase;
use Domains\Laravel\StarterKit\{Breeze, BreezeFrontend, StarterKit};
use Tests\TestCase;

class CreateProjectRequestTest extends TestCase
{
    /** @test */
    public function it_creates_a_complete_project_form(): void
    {
        file_put_contents('composer.json', preg_replace('/,\s*(\n|\n\r|\r\n)\s*"\.\/install\.sh"\s*$/m', '', file_get_contents('composer.json')));

        $request = CreateProjectRequest::create(
            '/create-project',
            parameters: [
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
            ],
        );

        $form = $request->buildForm();

        $metadata = $form->metadata;
        $this->assertEquals('foo', $metadata->vendorName);
        $this->assertEquals('bar', $metadata->projectName);
        $this->assertEquals(PhpVersion::v8_0, $metadata->phpVersion);
        $this->assertEquals('', $metadata->description);
        $this->assertEquals('foo/bar', $metadata->fullName());

        $authentication = $form->authentication;
        $starterKit = $authentication->starterKit;
        $this->assertInstanceOf(Breeze::class, $starterKit);
        $this->assertEquals(
            BreezeFrontend::BLADE,
            $starterKit->frontend->name,
        );
        $this->assertTrue($authentication->usesSocialite);
        $this->assertTrue($authentication->usesPassport);
        $this->assertTrue($authentication->usesFortify);

        $database = $form->database;
        $this->assertInstanceOf(MySQLDatabase::class, $database->database);

        $cache = $form->cache;
        $this->assertInstanceOf(RedisCacheDriver::class, $cache->driver);

        $queue = $form->queue;
        $this->assertNull($queue->driver);
        $this->assertTrue($queue->usesHorizon);

        $search = $form->search;
        $this->assertTrue($search->driver instanceof MeiliSearchScoutDriver);
        $this->assertInstanceOf(
            MeiliSearchScoutDriver::class,
            $search->driver,
        );

        $devTools = $form->developmentTools;
        $this->assertTrue($devTools->usesMailhog);
        $this->assertTrue($devTools->usesTelescope);
        $this->assertTrue($devTools->usesEnvoy);

        $testing = $form->testing;
        $this->assertTrue($testing->usesPest);
        $this->assertTrue($testing->usesDusk);

        $payment = $form->payment;
        $this->assertTrue($payment->driver instanceof CashierStripeDriver);

        $storage = $form->storage;
        $this->assertTrue($storage->usesMinIO);
    }
}
