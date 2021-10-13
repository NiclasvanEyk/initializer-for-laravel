<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\SourceCodeManipulation\Perl\AddTrait;

class CashierStripe extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'cashier-stripe';

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function packageId(): string
    {
        return 'laravel/cashier';
    }

    public function name(): string
    {
        return 'Stripe';
    }

    public function description(): string
    {
        return 'An expressive, fluent interface to Stripe\'s subscription '
            .'billing services.';
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
