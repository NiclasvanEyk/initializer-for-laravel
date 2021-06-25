<?php


namespace Domains\Laravel\ComposerPackages\Packages;


use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;

class Passport extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'passport';

    function description(): string
    {
        return 'A full OAuth2 server implementation for your Laravel '
            . 'application in a matter of minutes.';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            "Install Laravel Passport",
            fn () => [
                "$artisan migrate",
                "$artisan passport:install",
            ],
        );
    }
}
