<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\CreateProjectForm\Sections\Cashier\CashierDriver;
use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;
use Domains\CreateProjectForm\Sections\Cashier\CashierMollieDriver;
use Domains\CreateProjectForm\Sections\Cashier\CashierPaddleDriver;
use Domains\CreateProjectForm\Sections\Cashier\CashierStripeDriver;

class Payment
{
    public function __construct(
        public ?CashierDriver $driver,
    ) { }

    /**
     * @param string|null $option
     * @psalm-param CashierDriverOption::* $option
     * @return CashierDriver|null
     */
    public static function fromOption(?string $option): ?CashierDriver
    {
        return match($option) {
            CashierDriverOption::STRIPE => new CashierStripeDriver(),
            CashierDriverOption::PADDLE => new CashierPaddleDriver(),
            CashierDriverOption::MOLLIE => new CashierMollieDriver(),
            default => null,
        };
    }
}
