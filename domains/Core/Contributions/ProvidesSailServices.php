<?php

namespace Domains\Core\Contributions;

use Domains\Laravel\Sail\SailConfigurationOption;
use Illuminate\Support\Collection;

interface ProvidesSailServices
{
    /** @return Collection<SailConfigurationOption> */
    public function provideSailServices(): Collection;
}
