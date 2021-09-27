<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\Packages\CashierStripe;

class CashierStripeDriver extends CashierDriver
{
    public function package(): FirstPartyPackage
    {
        return new CashierStripe();
    }
}
