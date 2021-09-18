<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\Packages\CashierMollie;

class CashierMollieDriver extends CashierDriver
{
    function package(): FirstPartyPackage
    {
        return new CashierMollie();
    }
}
