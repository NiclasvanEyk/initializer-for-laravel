<?php

namespace Domains\ProjectTemplate\Console\Commands;

use Domains\ProjectTemplate\LaravelDownloader;
use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Console\Command;

class UpdateTemplateCommand extends Command
{
    protected $signature = 'initializer:update-template';
    protected $description = 'Downloads the latest release of Laravel if necessary.';

    public function handle(
        LaravelDownloader $downloader,
        TemplateStorage $templateStorage,
    ): void {
        $latestRelease = $downloader->latestRelease();

        if ($templateStorage->currentVersion() === $latestRelease->version) {
            $this->info("$latestRelease->version is still the latest release!");
            return;
        }

        $this->info("Downloading $latestRelease->version...");

        $downloadedRelease = $downloader->download($latestRelease);
        $templateStorage->updateCurrentRelease($downloadedRelease);

        $this->info("Finished downloading $latestRelease->version!");
    }
}
