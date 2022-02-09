<?php

namespace Domains\ProjectTemplateCustomization\Resolver;

use Domains\Composer\ComposerDependency;
use Domains\Composer\InlineComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Broadcasting;
use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Cache\DynamoDBCacheDBDriver;
use Domains\CreateProjectForm\Sections\Cache\RedisCacheDriver;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Mail;
use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
use Domains\CreateProjectForm\Sections\Notifications;
use Domains\CreateProjectForm\Sections\Notifications\NotificationChannelOptions as Channel;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Queue\RedisQueueDriver;
use Domains\CreateProjectForm\Sections\Queue\SqsQueueDriver;
use Domains\CreateProjectForm\Sections\Scout\AlgoliaScoutDriver;
use Domains\CreateProjectForm\Sections\Scout\MeiliSearchScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;
use Domains\Laravel\ComposerPackages\Packages\Dusk;
use Domains\Laravel\ComposerPackages\Packages\Envoy;
use Domains\Laravel\ComposerPackages\Packages\Fortify;
use Domains\Laravel\ComposerPackages\Packages\Horizon;
use Domains\Laravel\ComposerPackages\Packages\Passport;
use Domains\Laravel\ComposerPackages\Packages\Scout;
use Domains\Laravel\ComposerPackages\Packages\Socialite;
use Domains\Laravel\ComposerPackages\Packages\Telescope;
use Domains\Laravel\RelatedPackages\Broadcasting\Ably;
use Domains\Laravel\RelatedPackages\Broadcasting\LaravelWebsockets;
use Domains\Laravel\RelatedPackages\Broadcasting\Pusher;
use Domains\Laravel\RelatedPackages\Database\DoctrineDbal;
use Domains\Laravel\RelatedPackages\Infrastructure\AlgoliaSearch;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\S3Driver;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\SftpDriver;
use Domains\Laravel\RelatedPackages\Mail\MailgunMailer;
use Domains\Laravel\RelatedPackages\Mail\PostmarkMailer;
use Domains\Laravel\RelatedPackages\Testing\Pest;
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
            ...$this->forDatabase($form->database),
            ...$this->forCache($form->cache),
            ...$this->forQueue($form->queue),
            ...$this->forSearch($form->search),
            ...$this->forDevelopmentTools($form->developmentTools),
            ...$this->forTesting($form->testing),
            ...$this->forPayment($form->payment),
            ...$this->forStorage($form->storage),
            ...$this->forNotifications($form->notifications),
            ...$this->forMail($form->mail),
            ...$this->forBroadcasting($form->broadcasting),
        ]))->unique()->values();
    }

    /** @return array<ComposerDependency> */
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

    /** @return array<ComposerDependency> */
    public function forDatabase(Database $database): array
    {
        return $database->useDbal
            ? [new DoctrineDbal()]
            : [];
    }

    /** @return array<ComposerDependency> */
    public function forCache(Cache $cache): array
    {
        if ($cache->driver === null) {
            return [];
        }

        return match ($cache->driver::class) {
            RedisCacheDriver::class => [
                new InlineComposerDependency('predis/predis'),
            ],
            DynamoDBCacheDBDriver::class => [new AwsSdk()],
            default => [],
        };
    }

    /** @return array<ComposerDependency> */
    public function forQueue(Queue $queue): array
    {
        $packages = [];

        if ($queue->driver instanceof RedisQueueDriver) {
            $packages[] = new InlineComposerDependency('predis/predis');
        } elseif ($queue->driver instanceof SqsQueueDriver) {
            $packages[] = new AwsSdk();
        } elseif ($queue->driver instanceof Queue\BeanstalkdQueueDriver) {
            $packages[] = new InlineComposerDependency('pda/pheanstalk');
        }

        if ($queue->usesHorizon) {
            $packages[] = new Horizon();
        }

        return $packages;
    }

    /** @return array<ComposerDependency> */
    public function forSearch(Search $search): array
    {
        if ($search->driver === null) {
            return [];
        }

        $packages = [new Scout()];

        if ($search->driver instanceof MeiliSearchScoutDriver) {
            $packages[] = new InlineComposerDependency('meilisearch/meilisearch-php');
            $packages[] = new InlineComposerDependency('http-interop/http-factory-guzzle');
        } elseif ($search->driver instanceof AlgoliaScoutDriver) {
            $packages[] = new AlgoliaSearch();
        }

        return $packages;
    }

    /** @return array<ComposerDependency> */
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

    /** @return array<ComposerDependency> */
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

    /** @return array<ComposerDependency> */
    public function forPayment(Payment $payment): array
    {
        $packages = [];

        if ($payment->driver !== null) {
            $packages[] = $payment->driver->package();
        }

        return $packages;
    }

    /** @return array<ComposerDependency> */
    public function forStorage(Storage $storage): array
    {
        $packages = [];

        if ($storage->usesMinIO || $storage->usesS3) {
            $packages[] = new S3Driver();
        }

        if ($storage->usesSftp) {
            $packages[] = new SftpDriver();
        }

        return $packages;
    }

    /** @return array<ComposerDependency> */
    public function forNotifications(Notifications $notifications): array
    {
        return collect($notifications->channels)->flatMap(function (Channel $channel) {
            return match ($channel) {
                Channel::VONAGE => [],
                Channel::SLACK => [],
            };
        })->all();
    }

    /** @return array<ComposerDependency> */
    public function forMail(Mail $mail): array
    {
        $driverPackage = match ($mail->driver) {
            default => null,
            MailDriverOption::MAILGUN => new MailgunMailer(),
            MailDriverOption::POSTMARK => new PostmarkMailer(),
            MailDriverOption::SES => new AwsSdk(),
        };

        return $driverPackage !== null ? [$driverPackage] : [];
    }

    /** @return array<ComposerDependency> */
    public function forBroadcasting(Broadcasting $broadcasting): array
    {
        $channelPackages = match ($broadcasting->channel) {
            BroadcastingChannelOption::PUSHER => [new Pusher()],
            BroadcastingChannelOption::ABLY => [new Ably()],
            BroadcastingChannelOption::LARAVEL_WEBSOCKETS => [
                new LaravelWebsockets(),
                // See https://beyondco.de/docs/laravel-websockets/basic-usage/pusher
                new Pusher(),
            ],
            // Soketi is an NPM package and is handled elsewhere
            BroadcastingChannelOption::SOKETI,
            BroadcastingChannelOption::NONE => [],
            default => null,
        };

        return $channelPackages !== null ? $channelPackages : [];
    }
}
