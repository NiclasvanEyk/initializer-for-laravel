<?php

namespace Domains\CreateProjectForm\Http\Request\CreateProjectRequest;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\Sail\SailServiceRepository;
use Domains\Laravel\StarterKit\StarterKit;

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
            new Metadata(
                vendorName: $this->vendor,
                projectName: $this->project,
                description: $this->description ?? '',
                phpVersion: $this->php,
            ),
            new Authentication(
                starterKit: StarterKit::fromRequest($this),
                usesFortify: $this->has(P::USES_FORTIFY),
                usesPassport: $this->has(P::USES_PASSPORT),
                usesSocialite: $this->has(P::USES_SOCIALITE),
            ),
            new Database(
                database: $sailServiceRepository->resolve(
                    $this->database,
                ) ?? throw new \Exception("Database $this->database could not be resolved"),
            ),
            new Cache(
                driver: Cache::driverForOption(
                    $this->get(P::CACHE_DRIVER, CacheOption::default()),
                )
            ),
            new Queue(
                driver: Queue::driverForOption(
                    $this->get(P::QUEUE_DRIVER, QueueDriverOption::default())
                ),
                usesHorizon: $this->has(P::USES_HORIZON),
            ),
            new Search(
                driver: Search::driverForOption(
                    $this->get(P::SCOUT_DRIVER, ScoutDriverOption::default()),
                ),
            ),
            new DevelopmentTools(
                usesTelescope: $this->has(P::USES_TELESCOPE),
                usesMailhog: $this->has(P::USES_MAILHOG),
                usesEnvoy: $this->has(P::USES_ENVOY),
            ),
            new Testing(
                usesDusk: $this->has(P::USES_DUSK),
                usesPest: $this->has(P::USES_PEST),
            ),
            new Payment(
                driver: Payment::fromOption($this->get(P::CASHIER_DRIVER)),
            ),
            new Storage(
                usesMinIO: $this->has(P::USES_MINIO),
                usesSftp: $this->has(P::USES_FLYSYSTEM_SFTP_DRIVER),
                usesCachedAdapter: $this->has(P::USES_FLYSYSTEM_CACHED_ADAPTER),
                usesS3: $this->has(P::USES_FLYSYSTEM_S3_DRIVER),
            ),
        );
    }

    private function sailServiceRepository(): SailServiceRepository
    {
        return resolve(SailServiceRepository::class);
    }
}
