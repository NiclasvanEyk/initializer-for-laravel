<?php

namespace Tests\Feature\Domains\ProjectTemplate;

use Domains\ProjectTemplate\LaravelReleases;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domains\ProjectTemplate\LaravelReleases
 */
class LaravelDownloaderTest extends TestCase
{
    private LaravelReleases $downloader;

    protected function setUp(): void
    {
        parent::setUp();
        $this->downloader = $this->app->make(LaravelReleases::class);
    }

    /**
     * @test
     * @covers ::all
     */
    public function it_can_fetch_all_release_information(): void
    {
        $releases = $this->downloader->all();
        $this->assertNotNull($releases);
        $this->assertTrue(count($releases) > 50);
    }

    /**
     * @test
     * @covers ::latest
     */
    public function it_can_fetch_the_latest_release_information(): void
    {
        $this->assertNotNull($this->downloader->latest());
    }

    /**
     * @test
     * @covers ::download
     */
    public function it_can_download_the_released_archives(): void
    {
        $downloaded = $this->downloader->download(new Laravel862Package());

        $this->assertTrue($downloaded->archive->hasEntry('composer.json'));
        $this->assertStringContainsString(
            'laravel/laravel',
            $downloaded->archive->getEntryContents('composer.json'),
        );
    }
}
