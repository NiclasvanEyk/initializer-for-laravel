<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\PostDownloadTaskGroup;

class Octane extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    public function description(): string
    {
        return 'Run your application as one long running process, instead of booting it up for every request.';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
    }
}
