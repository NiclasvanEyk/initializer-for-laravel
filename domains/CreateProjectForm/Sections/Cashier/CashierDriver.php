<?php

namespace Domains\CreateProjectForm\Sections\Cashier;

use Domains\Laravel\ComposerPackages\FirstPartyPackage;

abstract class CashierDriver
{
    abstract public function package(): FirstPartyPackage;
}
