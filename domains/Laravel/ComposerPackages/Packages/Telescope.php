<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;

class Telescope extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'telescope';

    function description(): string
    {
        return 'A beautiful dashboard that provides insight into the requests'
            . ' coming into your application, exceptions, log entries,'
            . ' database queries, queued jobs, mail, notifications,'
            . ' cache operations, scheduled tasks, variable dumps, and more.';
    }

    public function isDevDependency(): bool
    {
        return true;
    }

    /**
     * @see https://laravel.com/docs/telescope#installation
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Telescope',
            fn () => [
                "$artisan telescope:install",
                "$artisan migrate",
            ],
        );
    }
}
