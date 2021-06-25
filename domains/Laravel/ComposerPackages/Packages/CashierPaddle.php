<?php

namespace Domains\Laravel\ComposerPackages\Packages;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

class CashierPaddle extends FirstPartyPackage
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
}
