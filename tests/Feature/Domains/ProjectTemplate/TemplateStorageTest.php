<?php

namespace Tests\Feature\Domains\ProjectTemplate;

use Domains\ProjectTemplate\DownloadedLaravelRelease;
use Domains\ProjectTemplate\LaravelReleases;
use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Support\Facades\Storage;
use PhpZip\ZipFile;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domains\ProjectTemplate\TemplateStorage
 */
class TemplateStorageTest extends TestCase
{
    private TemplateStorage $templateStorage;

    private function release862(): DownloadedLaravelRelease
    {
        static $release86 = null;

        if ($release86 === null) {
            $downloader = $this->app->make(LaravelReleases::class);
            $release86 = $downloader->download(new Laravel862Package());
        }

        return $release86;
    }

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('laravel-releases');
        $this->templateStorage = $this->app->make(TemplateStorage::class);
        $this->templateStorage->pathPrefix = storage_path('framework/testing/disks/laravel-releases');
    }

    /**
     * @test
     *
     * @covers ::exists
     */
    public function it_does_not_exist_by_default(): void
    {
        $this->assertFalse($this->templateStorage->exists());
    }

    /**
     * @test
     *
     * @covers ::exists
     */
    public function it_does_exist_once_something_was_downloaded(): void
    {
        $this->templateStorage->updateCurrentRelease($this->release862());
        $this->assertTrue($this->templateStorage->exists());
    }

    /**
     * @test
     *
     * @covers ::currentVersion
     */
    public function it_does_not_throw_when_no_version_exists_and_currentVersion_is_called(): void
    {
        $this->assertEquals('unknown', $this->templateStorage->currentVersion());
    }

    /**
     * @test
     *
     * @covers ::currentVersion
     * @covers ::updateCurrentRelease
     */
    public function it_knows_the_latest_downloaded_version(): void
    {
        $this->templateStorage->updateCurrentRelease($this->release862());
        $this->assertEquals('v8.6.2', $this->templateStorage->currentVersion());
    }

    /**
     * @test
     *
     * @covers ::currentArchive
     */
    public function it_can_return_the_latest_downloaded_archive(): void
    {
        $this->templateStorage->updateCurrentRelease($this->release862());
        $downloaded = $this->templateStorage->currentArchive();
        $this->assertInstanceOf(ZipFile::class, $downloaded);
        $this->assertStringContainsString(
            'laravel/laravel',
            $downloaded->getEntryContents('composer.json'),
        );
    }
}
