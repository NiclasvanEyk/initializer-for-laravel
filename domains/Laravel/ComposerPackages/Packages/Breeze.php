<?php


namespace Domains\Laravel\ComposerPackages\Packages;


use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\Laravel\StarterKit\BreezeFrontend;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;

class Breeze extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    public function __construct(
        private BreezeFrontend $frontend,
        private bool $usesPest = false,
    ) { }

    const REPOSITORY_KEY = 'breeze';

    function description(): string
    {
        return 'A minimal, simple implementation of all of Laravel\'s '
            . 'authentication features, including login, registration, '
            . 'password reset, email verification, and password confirmation.';
    }

    public function href(): string
    {
        return 'https://laravel.com/docs/starter-kits#laravel-breeze';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Install Laravel Breeze',
            function () use ($artisan) {
                $install = "$artisan breeze:install";

                if ($this->usesPest) {
                    $install .= " --pest";
                }

                $install .= " $this->frontend";

                return [$install];
        });
    }
}
