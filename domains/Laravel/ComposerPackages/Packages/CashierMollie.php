<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class CashierMollie extends FirstPartyPackage
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
}
