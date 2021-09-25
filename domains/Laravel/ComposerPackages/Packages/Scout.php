<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;

class Scout extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'scout';

    function description(): string
    {
        return 'A simple, driver based solution for adding full-text search to '
            . 'your Eloquent models.';
    }

    /**
     * @see https://laravel.com/docs/scout#installation
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Scout',
            fn () => [
                "$artisan vendor:publish --provider=\"Laravel\Scout\ScoutServiceProvider\"",
            ],
        );
    }
}
