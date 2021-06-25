<?php

namespace App\Dependencies\Laravel;

class CashierPaddle extends FirstPartyPackage
{
    function id(): string
    {
        return 'cashier-paddle';
    }

    function name(): string
    {
        return 'Cashier (Paddle)';
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
}
