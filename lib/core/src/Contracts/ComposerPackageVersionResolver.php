<?php

namespace InitializerForLaravel\Core\Contracts;

interface ComposerPackageVersionResolver
{
    /**
     * @param  array<int, string>  $packages
     * @return array<string, string> $versionByPackage
     */
    public function resolve(array $packages): array;
}
