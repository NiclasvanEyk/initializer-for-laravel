<?php

namespace InitializerForLaravel\Core\Console\Commands;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Contracts\TemplateRetriever;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use Illuminate\Console\Command;
use InitializerForLaravel\Core\Exception\NoTemplateDownloaderAvailableException;
use Log;

class UpdateTemplateCommand extends Command
{
    protected $signature = 'initializer:update-template';
    protected $description = 'Downloads the latest release of the project template if necessary.';

    public function handle(TemplateStorage $templateStorage): void
    {
        $retriever = $this->resolveTemplateRetriever();

        $latestRelease = $retriever->latest();

        $storedVersion = $templateStorage->version();
        if ($storedVersion && $storedVersion === $latestRelease->version) {
            $this->logAndInfo("$latestRelease->version is still the latest release!");
            return;
        }

        $this->logAndInfo("Downloading $latestRelease->version...");
        $archive = $retriever->fetch($latestRelease);
        $templateStorage->update($latestRelease->version, $archive);

        $this->logAndInfo("Finished downloading $latestRelease->version!");
    }

    private function logAndInfo(string $message): void
    {
        $this->info($message);
        Log::info($message);
    }

    /**
     * @throws BindingResolutionException
     * @throws NoTemplateDownloaderAvailableException
     */
    private function resolveTemplateRetriever(): TemplateRetriever
    {
        try {
            $downloader = app(TemplateRetriever::class);
        } catch (BindingResolutionException $exception) {
            NoTemplateDownloaderAvailableException::throwWhenApplicable($exception);

            throw $exception;
        }
        return $downloader;
    }
}
