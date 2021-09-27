<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;

class Dusk extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'dusk';

    public function description(): string
    {
        return 'An expressive, easy-to-use browser automation and testing API.'
            .' Includes a Sail service for Selenium.';
    }

    public function isDevDependency(): bool
    {
        return true;
    }

    /**
     * @see https://laravel.com/docs/dusk#installation
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Dusk',
            fn () => ["$artisan dusk:install"],
        );
    }
}
