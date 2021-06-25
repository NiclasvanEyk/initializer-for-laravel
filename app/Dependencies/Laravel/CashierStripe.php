<?php

namespace App\Dependencies\Laravel;

class CashierStripe extends FirstPartyPackage
{
    function id(): string
    {
        return 'cashier-stripe';
    }

    function name(): string
    {
        return 'Cashier (Stripe)';
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
