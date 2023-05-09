<?php

namespace Tests\Feature\Domains\ProjectTemplate;

use Domains\ProjectTemplate\LaravelDownloader;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domains\ProjectTemplate\LaravelDownloader
 */
class LaravelDownloaderTest extends TestCase
{
    private LaravelDownloader $downloader;

    protected function setUp(): void
    {
        parent::setUp();
        $this->downloader = $this->app->make(LaravelDownloader::class);
    }

    /**
     * @test
     *
     * @covers ::laravelReleases
     */
    public function it_can_fetch_all_release_information(): void
    {
        $releases = $this->downloader->laravelReleases();
        $this->assertNotNull($releases);
        $this->assertTrue(count($releases) > 50);
    }

    /**
     * @test
     *
     * @covers ::latestRelease
     */
    public function it_can_fetch_the_latest_release_information(): void
    {
        $this->assertNotNull($this->downloader->latestRelease());
    }

    /**
     * @test
     *
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
