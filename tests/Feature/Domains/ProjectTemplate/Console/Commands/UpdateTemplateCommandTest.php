<?php

namespace Tests\Feature\Domains\ProjectTemplate\Console\Commands;

use Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand;
use Domains\ProjectTemplate\LaravelDownloader;
use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Domains\ProjectTemplate\Laravel862Package;
use Tests\TestCase;

/**
 * @covers \Domains\ProjectTemplate\Console\Commands\UpdateTemplateCommand
 */
class UpdateTemplateCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        $this->app->singleton(LaravelDownloader::class, fn () => $this
            ->spy(LaravelDownloader::class)
            ->shouldReceive('latestRelease')
            ->andReturn(new Laravel862Package())
            ->getMock()
        );
    }

    private function setCurrentlyDownloadedVersion(string $version): void
    {
        $this->app->singleton(TemplateStorage::class, fn () => $this
            ->spy(TemplateStorage::class)
            ->shouldReceive('currentVersion')
            ->andReturn($version)
            ->getMock()
        );
    }

    /** @test */
    public function it_can_download_the_latest_release(): void
    {
        $this->setCurrentlyDownloadedVersion('v1.0.0');

        $this
            ->artisan(UpdateTemplateCommand::class)
            ->expectsOutput('Downloading v8.6.2...')
            ->expectsOutput('Finished downloading v8.6.2!')
            ->doesntExpectOutput('v8.6.2 is still the latest release!')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_does_not_downloaded_already_stored_releases(): void
    {
        $this->setCurrentlyDownloadedVersion('v8.6.2');

        $this
            ->artisan(UpdateTemplateCommand::class)
            ->doesntExpectOutput('Downloading v8.6.2...')
            ->doesntExpectOutput('Finished downloading v8.6.2!')
            ->expectsOutput('v8.6.2 is still the latest release!')
            ->assertExitCode(0);
    }
}
