<?php


namespace Domains\Laravel\ComposerPackages\Packages;


use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;

class Horizon extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'horizon';

    function description(): string
    {
        return 'A beautiful dashboard and code-driven configuration for your '
            . 'Laravel powered Redis queues.';
    }

    public function isDevDependency(): bool
    {
        return true;
    }

    /**
     * @see https://laravel.com/docs/horizon#installation
     */
    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Setup Laravel Horizon',
            fn () => ["$artisan horizon:install"],
        );
    }
}
