<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Support\Enum\EmulatesEnum;

class CashierDriverOption
{
    use EmulatesEnum;

    public const NONE = 'none';
    public const STRIPE = 'stripe';
    public const PADDLE = 'paddle';
    public const MOLLIE = 'mollie';

    public static function default(): string
    {
        return self::NONE;
    }
}
