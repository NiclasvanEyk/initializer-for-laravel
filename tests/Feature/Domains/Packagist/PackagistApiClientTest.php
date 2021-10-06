<?php

namespace Tests\Feature\Domains\Packagist;

use Domains\Packagist\PackagistApiClient;
use Tests\TestCase;

/**
 * @covers \Domains\Packagist\PackagistApiClient
 * @covers \Domains\Packagist\Models\Package
 * @covers \Domains\Packagist\Models\PackageDist
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
