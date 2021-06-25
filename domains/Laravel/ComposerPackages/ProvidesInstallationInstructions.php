<?php

namespace Domains\Laravel\ComposerPackages;

use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;

interface ProvidesInstallationInstructions
{
    /**
     * @param string $artisan Path to the artisan binary
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup;
}
