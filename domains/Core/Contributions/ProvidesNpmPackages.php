<?php

namespace Domains\Core\Contributions;

use Domains\NodeJs\NpmDependency;
use Illuminate\Support\Collection;

interface ProvidesNpmPackages
{
    /**
     * The npm packages chosen by the user.
     *
     * @return Collection<int, NpmDependency>
     */
    public function npmPackages(): Collection;
}
