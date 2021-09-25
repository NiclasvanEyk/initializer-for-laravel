<?php

namespace Tests\Domains\Composer;

use Domains\Composer\PackageVersionToInstallResolver;
use Domains\Laravel\ComposerPackages\Packages\Envoy;
use Domains\Laravel\ComposerPackages\Packages\Fortify;
use Domains\Laravel\ComposerPackages\Packages\Jetstream;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Tests\TestCase;

class PackageVersionToInstallResolverTest extends TestCase
{
    /** @test */
    public function it_resolves_something()
    {
        $result = (new PackageVersionToInstallResolver())->resolve(collect([
            new AwsSdk(),
            new Fortify(),
            new Envoy(),
            new Jetstream(),
        ]));

        $all = $result->all();
    }
}
