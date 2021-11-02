<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\Tasks\WaitForDatabase;
use Domains\SourceCodeManipulation\Perl\AddTrait;

class Passport extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'passport';

    public function description(): string
    {
        return 'A full OAuth2 server implementation for your Laravel '
            .'application in a matter of minutes.';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Install Laravel Passport',
            fn () => [
                new WaitForDatabase($artisan),
                "$artisan migrate",
                "$artisan passport:install",
                AddTrait::toUserModel('\\Laravel\\Passport\\HasApiTokens'),
            ],
        );
    }
}
