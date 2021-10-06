<?php

namespace Domains\ProjectTemplate\Console\Commands;

use Domains\ProjectTemplate\LaravelDownloader;
use Domains\ProjectTemplate\TemplateStorage;
use Illuminate\Console\Command;
use Log;

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
            $this->logAndInfo("$latestRelease->version is still the latest release!");

            return;
        }

        $this->logAndInfo("Downloading $latestRelease->version...");

        $downloadedRelease = $downloader->download($latestRelease);
        $templateStorage->updateCurrentRelease($downloadedRelease);

        $this->logAndInfo("Finished downloading $latestRelease->version!");
    }

    private function logAndInfo(string $message): void
    {
        $this->info($message);
        Log::info($message);
    }
}
