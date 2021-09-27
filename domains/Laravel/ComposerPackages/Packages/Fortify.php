<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;

class Fortify extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'fortify';

    function description(): string
    {
        return 'A backend-only implementation for Laravel\'s authentication '
             . 'features. Allows you to build your own custom '
             . 'user interface for authentication, without reimplementing '
             . 'all the backend functionality. Not needed if you chose Breeze '
             . 'or Jetstream as your starter kit.';
    }

    /**
     * @see https://laravel.com/docs/fortify#installation
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Fortify',
            fn () => [
                "$artisan vendor:publish --no--interaction --provider=\"Laravel\Fortify\FortifyServiceProvider\"",
                "$artisan migrate",
            ],
        );
    }
}
