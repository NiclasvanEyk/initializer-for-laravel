<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
use Domains\PostDownload\ClosurePostInstallTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\SourceCodeManipulation\SedCommand\AddTrait;

class CashierMollie extends FirstPartyPackage implements ProvidesInstallationInstructions
{
    const REPOSITORY_KEY = 'cashier-mollie';

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'Mollie';
    }

    function description(): string
    {
        return 'An expressive, fluent interface to subscriptions'
            . ' using Mollie\'s billing services';
    }

    public function href(): string
    {
        return 'https://github.com/laravel/cashier-mollie';
    }

    public function installationInstructions(string $artisan): PostDownloadTaskGroup
    {
        return new ClosurePostInstallTaskGroup(
            'Add Billable Trait to User model',
            fn () => [AddTrait::toUserModel('\\Laravel\\Cashier\\Billable')],
        );
    }
}
