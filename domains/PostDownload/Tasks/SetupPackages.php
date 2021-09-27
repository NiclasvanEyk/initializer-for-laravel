<?php

namespace Domains\PostDownload\Tasks;

use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\PostDownloadTaskGroup;
use Illuminate\Support\Collection;

/**
 * Runs package setup, e.g. <code>artisan breeze:install</code>.
 */
class SetupPackages implements PostDownloadTaskGroup
{
    /**
     * @param string $artisan
     * @param ProvidesInstallationInstructions[]|Collection $dependencies
     */
    public function __construct(
        private string $artisan,
        private Collection $dependencies,
    ) { }

    public function title(): string
    {
        return "Setup composer dependencies";
    }

    /** @return array<PostDownloadTaskGroup> */
    public function tasks(): array
    {
        return $this->dependencies
            ->filter(fn ($p) => $p instanceof ProvidesInstallationInstructions)
            ->map(fn (ProvidesInstallationInstructions $instructions) =>
                $instructions->installationInstructions($this->artisan)
            )
            ->all();
    }
}
