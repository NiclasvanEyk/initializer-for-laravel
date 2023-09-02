<?php

namespace Domains\ProjectTemplate;

class ProjectTemplateService
{
    public function __construct(
        private readonly TemplateStorage $storage,
        private readonly LaravelDownloader $downloader,
    ) {
    }

    public function canBeUpdated() : bool
    {
        $latestRelease = $this->downloader->latestRelease();
        $currentVersion = $this->storage->currentVersion();

        return $latestRelease->version !== $currentVersion;
    }

    public function update() : void
    {
        $latestRelease = $this->downloader->latestRelease();
        $downloadedRelease = $this->downloader->download($latestRelease);
        $this->storage->updateCurrentRelease($downloadedRelease);
    }
}
