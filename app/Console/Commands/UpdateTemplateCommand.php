<?php

namespace App\Console\Commands;

use Domains\ProjectTemplate\LaravelReleases;
use Illuminate\Console\Command;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use Log;

class UpdateTemplateCommand extends Command
{
    protected $signature = 'initializer:update-template';
    protected $description = 'Downloads the latest release of Laravel if necessary.';

    public function handle(
        LaravelReleases $downloader,
        TemplateStorage $templateStorage,
    ): void {
        $latestRelease = $downloader->latest();

        $storedVersion = $templateStorage->version();
        if ($storedVersion && $storedVersion === $latestRelease->version) {
            $this->logAndInfo("$latestRelease->version is still the latest release!");

            return;
        }

        $this->logAndInfo("Downloading $latestRelease->version...");
        $release = $downloader->download($latestRelease);
        $templateStorage->update($release->package->version, $release->archive);

        $this->logAndInfo("Finished downloading $latestRelease->version!");
    }

    private function logAndInfo(string $message): void
    {
        $this->info($message);
        Log::info($message);
    }
}
