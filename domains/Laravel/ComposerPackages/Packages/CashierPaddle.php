<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;
use Domains\SourceCodeManipulation\SedCommand\AddTrait;

class CashierPaddle extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'cashier-paddle';

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'Paddle';
    }

    function description(): string
    {
        return 'An expressive, fluent interface to Paddle\'s subscription '
            . 'billing services.';
    }

    public function href(): string
    {
        return self::laravelDocsHref('cashier-paddle');
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Add Billable Trait to User model',
            fn () => [AddTrait::toUserModel('\\Laravel\\Paddle\\Billable')],
        );
    }
}
