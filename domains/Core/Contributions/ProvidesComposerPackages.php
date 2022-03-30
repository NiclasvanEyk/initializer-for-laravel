<?php

namespace Domains\Core\Contributions;

use Domains\Packagist\Models\Package;
use Illuminate\Support\Collection;

interface ProvidesComposerPackages
{
    /**
     * The composer packages chosen by the user.
     *
     * @return Collection<int, Package>
     */
    public function composerPackages(): Collection;
}
