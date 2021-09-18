<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;
use Domains\Laravel\ComposerPackages\Packages\CashierPaddle;

class CashierPaddleDriver extends CashierDriver
{
    function package(): FirstPartyPackage
    {
        return new CashierPaddle();
    }
}
