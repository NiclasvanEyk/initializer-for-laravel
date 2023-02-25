<?php

namespace Tests\Feature\Domains\Packagist;

use InitializerForLaravel\Packagist\PackagistApiClient;
use Tests\TestCase;

/**
 * @covers \InitializerForLaravel\Packagist\PackagistApiClient
 * @covers \InitializerForLaravel\Packagist\Package
 * @covers \InitializerForLaravel\Packagist\PackageDist
 */
class PackagistApiClientTest extends TestCase
{
    /** @test */
    public function it_can_find_laravel(): void
    {
        $client = $this->app->make(PackagistApiClient::class);
        $results = $client->packageReleases('laravel', 'laravel');

        $this->assertTrue(count($results) > 100);
    }
}
