<?php

namespace InitializerForLaravel\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Contracts\TemplateDownloader;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\NoTemplateDownloaderAvailableException;
use Log;
use function resolve;

class UpdateTemplateCommand extends Command
{
    protected $signature = 'initializer:update-template';
    protected $description = 'Downloads the latest release of the project template if necessary.';

    public function handle(TemplateStorage $templateStorage): void
    {
        try {
            $downloader = app(TemplateDownloader::class);
        } catch (BindingResolutionException $exception) {
            if (Str::contains($exception->getMessage(), TemplateDownloader::class)) {
                throw new NoTemplateDownloaderAvailableException(previous: $exception);
            }

            throw $exception;
        }

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
