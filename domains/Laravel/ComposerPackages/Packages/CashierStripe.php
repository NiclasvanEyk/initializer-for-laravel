<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class CashierStripe extends FirstPartyPackage
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
        return self::laravelDocsHref('cashier-stripe');
    }
}
