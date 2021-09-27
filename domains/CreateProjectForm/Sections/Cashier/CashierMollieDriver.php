<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\Packages\CashierMollie;

class CashierMollieDriver extends CashierDriver
{
    public function package(): FirstPartyPackage
    {
        return new CashierMollie();
    }
}
