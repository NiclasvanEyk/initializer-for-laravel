<?php

namespace Tests\Feature\Domains\ProjectTemplate;

use Domains\Packagist\PackagistApiClient;
use Domains\ProjectTemplate\DownloadedLaravelRelease;
use Domains\ProjectTemplate\LaravelDownloader;
use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Support\Facades\Storage;
use PhpZip\ZipFile;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domains\ProjectTemplate\TemplateStorage
 */
class TemplateStorageTest extends TestCase
{
    private static DownloadedLaravelRelease $release862;
    private TemplateStorage $templateStorage;

    public static function setUpBeforeClass(): void
    {
        self::createStaticApplication();
        $downloader = (new LaravelDownloader(new PackagistApiClient()));
        self::$release862 = $downloader->download(new Laravel862Package());
    }

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('laravel-releases');
        $this->templateStorage = $this->app->make(TemplateStorage::class);
    }

    /**
     * @test
     * @covers ::exists
     */
    public function it_does_not_exist_by_default(): void
    {
        $this->assertFalse($this->templateStorage->exists());
    }

    /**
     * @test
     * @covers ::exists
     */
    public function it_does_exist_once_something_was_downloaded(): void
    {
        $this->templateStorage->updateCurrentRelease(self::$release862);
        $this->assertTrue($this->templateStorage->exists());
    }

    /**
     * @test
     * @covers ::currentVersion
     */
    public function it_does_not_throw_when_no_version_exists_and_currentVersion_is_called(): void
    {
        $this->assertEquals('unknown', $this->templateStorage->currentVersion());
    }

    /**
     * @test
     * @covers ::currentVersion
     * @covers ::updateCurrentRelease
     */
    public function it_knows_the_latest_downloaded_version(): void
    {
        $this->templateStorage->updateCurrentRelease(self::$release862);
        $this->assertEquals('v8.6.2', $this->templateStorage->currentVersion());
    }

    /**
     * @test
     * @covers ::currentArchive
     */
    public function it_can_return_the_latest_downloaded_archive(): void
    {
        $this->templateStorage->updateCurrentRelease(self::$release862);
        $downloaded = $this->templateStorage->currentArchive();
        $this->assertInstanceOf(ZipFile::class, $downloaded);
        $this->assertStringContainsString(
            'laravel/laravel',
            $downloaded->getEntryContents('composer.json'),
        );
    }
}
