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
                // Yes, all of these slashes are needed:
                // - 1x to escape it in the php string
                // - 1x to escape it in the shell command string
                // - 1x to escape it in the regex itself
                'sed "s/use HasApiTokens/use \\\\\\\\Laravel\\\\\\\\Passport\\\\\\\\HasApiTokens, HasApiTokens/g" app/Models/User.php | tee app/Models/User.php > /dev/null'
            ],
        );
    }
}
