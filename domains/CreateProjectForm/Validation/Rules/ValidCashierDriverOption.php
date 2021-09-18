<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;
use Illuminate\Validation\Rules\In;

class ValidCashierDriverOption extends In
{
    public function __construct()
    {
        parent::__construct(CashierDriverOption::values());
    }
}
