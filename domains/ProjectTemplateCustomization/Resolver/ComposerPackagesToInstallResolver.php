<?php

namespace Domains\ProjectTemplateCustomization\Resolver;

use Domains\Composer\InlineComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\DynamoDBCacheDBDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\CreateProjectForm\Sections\Cashier\CashierPaddleDriver;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Queue\SqsQueueDriver;
use Domains\CreateProjectForm\Sections\Scout\AlgoliaScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\MeiliSearchScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\ComposerPackages\Packages\CashierMollie;
use Domains\Laravel\ComposerPackages\Packages\CashierPaddle;
use Domains\Laravel\ComposerPackages\Packages\CashierStripe;
use Domains\Laravel\ComposerPackages\Packages\Dusk;
use Domains\Laravel\ComposerPackages\Packages\Envoy;
use Domains\Laravel\ComposerPackages\Packages\Fortify;
use Domains\Laravel\ComposerPackages\Packages\Horizon;
use Domains\Laravel\ComposerPackages\Packages\Passport;
use Domains\Laravel\ComposerPackages\Packages\Scout;
use Domains\Laravel\ComposerPackages\Packages\Socialite;
use Domains\Laravel\ComposerPackages\Packages\Telescope;
use Domains\Laravel\RelatedPackages\Community\Pest;
use Domains\Laravel\RelatedPackages\Infrastructure\AlgoliaSearch;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\CachedAdapter;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\S3Driver;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\SftpDriver;
use Illuminate\Support\Collection;

/**
 * Derives the set of composer packages, that need to be installed for the given
 * {@link CreateProjectForm} values.
 */
class ComposerPackagesToInstallResolver
{
    public function resolveFor(CreateProjectForm $form): Collection
    {
        return (new Collection([
            ...$this->forAuthentication($form->authentication),
            ...$this->forCache($form->cache),
            ...$this->forQueue($form->queue),
            ...$this->forSearch($form->search),
            ...$this->forDevelopmentTools($form->developmentTools),
            ...$this->forTesting($form->testing),
            ...$this->forPayment($form->payment),
            ...$this->forStorage($form->storage),
        ]))->unique()->values();
    }

    public function forAuthentication(Authentication $authentication): array
    {
        $packages = [];

        $starterKitPackage = $authentication->starterKit->composerPackage();

        if ($starterKitPackage !== null) {
            $packages[] = $starterKitPackage;
        }

        if ($authentication->usesFortify) {
            $packages[] = new Fortify();
        }

        if ($authentication->usesPassport) {
            $packages[] = new Passport();
        }

        if ($authentication->usesSocialite) {
            $packages[] = new Socialite();
        }

        return $packages;
    }

    public function forCache(Cache $cache): array
    {
        if ($cache->driver === null) return [];

        return match($cache->driver::class) {
            RedisCacheDriver::class => [
                new InlineComposerDependency('predis/predis'),
            ],
            DynamoDBCacheDBDriver::class => [new AwsSdk()],
            default => [],
        };
    }

    public function forQueue(Queue $queue): array
    {
        $packages = [];

        if ($queue->driver instanceof RedisQueueDriver) {
            $packages[] = new InlineComposerDependency('predis/predis');
        } else if ($queue->driver instanceof SqsQueueDriver) {
            $packages[] = new AwsSdk();
        } else if ($queue->driver instanceof Queue\BeanstalkdQueueDriver) {
            $packages[] = new InlineComposerDependency('pda/pheanstalk');
        }

        if ($queue->usesHorizon) {
            $packages[] = new Horizon();
        }

        return $packages;
    }

    public function forSearch(Search $search): array
    {
        if ($search->driver === null) {
            return [];
        }

        $packages = [new Scout()];

        if ($search->driver instanceof MeiliSearchScoutDriver) {
            $packages[] = new InlineComposerDependency('meilisearch/meilisearch-php');
            $packages[] = new InlineComposerDependency('http-interop/http-factory-guzzle');
        } else if ($search->driver instanceof AlgoliaScoutDriver) {
            $packages[] = new AlgoliaSearch();
        }

        return $packages;
    }

    public function forDevelopmentTools(
        DevelopmentTools $developmentTools,
    ): array {
        $packages = [];

        if ($developmentTools->usesEnvoy) {
            $packages[] = new Envoy();
        }

        if ($developmentTools->usesTelescope) {
            $packages[] = new Telescope();
        }

        return $packages;
    }

    public function forTesting(Testing $testing): array
    {
        $packages = [];

        if ($testing->usesDusk) {
            $packages[] = new Dusk();
        }

        if ($testing->usesPest) {
            $packages[] = new Pest();
        }

        return $packages;
    }

    public function forPayment(Payment $payment): array
    {
        $packages = [];

        if ($payment->driver !== null) {
            $packages[] = $payment->driver->package();
        }

        return $packages;
    }

    public function forStorage(Storage $storage): array
    {
        $packages = [];

        if ($storage->usesMinIO || $storage->usesS3) {
            $packages[] = new S3Driver();
        }

        if ($storage->usesSftp) {
            $packages[] = new SftpDriver();
        }

        if ($storage->usesCachedAdapter) {
            $packages[] = new CachedAdapter();
        }

        return $packages;
    }
}
