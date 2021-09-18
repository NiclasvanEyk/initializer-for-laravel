<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\ProjectTemplateCustomization\PostDownload\ClosurePostInstallTaskGroup;
use Domains\ProjectTemplateCustomization\PostDownload\PostDownloadTaskGroup;
use Domains\SourceCodeManipulation\SedCommand\AddTrait;

class CashierStripe extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'cashier-stripe';

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function packageId(): string
    {
        return 'laravel/cashier';
    }

    function name(): string
    {
        return 'Stripe';
    }

    function description(): string
    {
        return 'An expressive, fluent interface to Stripe\'s subscription '
            . 'billing services.';
    }

    public function href(): string
    {
        return self::laravelDocsHref('billing');
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Add Billable Trait to User model',
            fn () => [AddTrait::toUserModel('\\Laravel\\Cashier\\Billable')],
        );
    }
}
