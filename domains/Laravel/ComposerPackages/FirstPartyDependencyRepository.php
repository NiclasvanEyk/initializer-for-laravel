<?php

namespace Domains\Laravel\ComposerPackages;

use function collect;
use Domains\Laravel\ComposerPackages\Packages\Breeze;
use Domains\Laravel\ComposerPackages\Packages\CashierPaddle;
use Domains\Laravel\ComposerPackages\Packages\CashierStripe;
use Domains\Laravel\ComposerPackages\Packages\Dusk;
use Domains\Laravel\ComposerPackages\Packages\Envoy;
use Domains\Laravel\ComposerPackages\Packages\Fortify;
use Domains\Laravel\ComposerPackages\Packages\Horizon;
use Domains\Laravel\ComposerPackages\Packages\Jetstream;
use Domains\Laravel\ComposerPackages\Packages\Passport;
use Domains\Laravel\ComposerPackages\Packages\Sanctum;
use Domains\Laravel\ComposerPackages\Packages\Scout;
use Domains\Laravel\ComposerPackages\Packages\Socialite;
use Domains\Laravel\ComposerPackages\Packages\Telescope;

class FirstPartyDependencyRepository
{
    /**
     * @var array<string, class-string>
     */
    public static array $dependencyMap = [
        Breeze::REPOSITORY_KEY => Breeze::class,
        CashierPaddle::REPOSITORY_KEY => CashierPaddle::class,
        CashierStripe::REPOSITORY_KEY => CashierStripe::class,
        Dusk::REPOSITORY_KEY => Dusk::class,
        Envoy::REPOSITORY_KEY => Envoy::class,
        Fortify::REPOSITORY_KEY => Fortify::class,
        Horizon::REPOSITORY_KEY => Horizon::class,
        Jetstream::REPOSITORY_KEY => Jetstream::class,
        Passport::REPOSITORY_KEY => Passport::class,
        Sanctum::REPOSITORY_KEY => Sanctum::class,
        Scout::REPOSITORY_KEY => Scout::class,
        Socialite::REPOSITORY_KEY => Socialite::class,
        Telescope::REPOSITORY_KEY => Telescope::class,
    ];

    /**
     * @param  string  ...$ids
     * @return list<FirstPartyPackage>
     */
    public function resolveAll(string ...$ids): array
    {
        return collect($ids)->map([$this, 'resolve'])->values()->all();
    }

    public function resolve(string $dependency): FirstPartyPackage
    {
        return new self::$dependencyMap[$dependency]();
    }
}
