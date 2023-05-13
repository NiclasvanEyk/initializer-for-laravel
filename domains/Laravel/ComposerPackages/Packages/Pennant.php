<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\Tasks\WaitForDatabase;

class Pennant extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'pennant';

    public function description(): string
    {
        return 'A simple, lightweight library for managing feature flags.';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Install Laravel Pennant',
            fn () => [
                "$artisan vendor:publish --provider=\"Laravel\Pennant\PennantServiceProvider\"",
                new WaitForDatabase($artisan),
                "$artisan migrate",
            ],
        );
    }
}
