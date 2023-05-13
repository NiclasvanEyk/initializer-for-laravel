<?php

namespace Domains\CreateProjectForm\Http\Request\CreateProjectRequest;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Broadcasting;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Mail;
use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Notifications;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\Sail\SailServiceRepository;
use Domains\Laravel\StarterKit\StarterKit;
use Exception;

/**
 * Functionality for the {@link CreateProjectRequest} to build
 * {@link CreateProjectForm} objects, which actually contain domain objects
 * instead of strings.
 *
 * @mixin CreateProjectRequest
 */
trait BuildsCreateProjectForm
{
    public function buildForm(): CreateProjectForm
    {
        $sailServiceRepository = $this->sailServiceRepository();

        return new CreateProjectForm(
            metadata: new Metadata(
                vendorName: $this->vendor,
                projectName: $this->project,
                description: $this->description ?? '',
                phpVersion: $this->php,
            ),
            authentication: new Authentication(
                starterKit: StarterKit::fromRequest($this),
                usesFortify: $this->has(P::USES_FORTIFY),
                usesPassport: $this->has(P::USES_PASSPORT),
                usesSocialite: $this->has(P::USES_SOCIALITE),
            ),
            database: new Database(
                database: $sailServiceRepository->resolve(
                    $this->database,
                ) ?? throw new Exception("Database $this->database could not be resolved"),
                useDbal: $this->has(P::USES_DBAL)
            ),
            cache: new Cache(
                driver: Cache::driverForOption(
                    $this->get(P::CACHE_DRIVER, CacheOption::default()),
                )
            ),
            queue: new Queue(
                driver: Queue::driverForOption(
                    $this->get(P::QUEUE_DRIVER, QueueDriverOption::default())
                ),
                usesHorizon: $this->has(P::USES_HORIZON),
            ),
            mail: new Mail(
                driver: MailDriverOption::tryFrom($this->get(P::MAIL_DRIVER)) ?? MailDriverOption::default(),
                usesMailhog: $this->has(P::USES_MAILHOG),
            ),
            notifications: new Notifications(
                channels: $this->get(P::NOTIFICATION_CHANNELS, []),
            ),
            broadcasting: new Broadcasting(
                channel: Broadcasting\BroadcastingChannelOption::tryFrom(
                    $this->get(P::BROADCASTING_CHANNEL)
                ) ?? Broadcasting\BroadcastingChannelOption::default(),
            ),
            search: new Search(
                driver: ScoutDriver::tryFrom(
                    $this->get(P::SCOUT_DRIVER),
                ) ?? ScoutDriver::default(),
            ),
            developmentTools: new DevelopmentTools(
                usesTelescope: $this->has(P::USES_TELESCOPE),
                usesEnvoy: $this->has(P::USES_ENVOY),
                usesDevcontainer: $this->has(P::USES_DEVCONTAINER),
            ),
            testing: new Testing(
                usesDusk: $this->has(P::USES_DUSK),
                usesPest: $this->has(P::USES_PEST),
            ),
            payment: new Payment(
                driver: Payment::fromOption($this->get(P::CASHIER_DRIVER)),
            ),
            storage: new Storage(
                usesMinIO: $this->has(P::USES_MINIO),
                usesSftp: $this->has(P::USES_FLYSYSTEM_SFTP_DRIVER),
                usesS3: $this->has(P::USES_FLYSYSTEM_S3_DRIVER),
            ),
        );
    }

    private function sailServiceRepository(): SailServiceRepository
    {
        return resolve(SailServiceRepository::class);
    }
}
