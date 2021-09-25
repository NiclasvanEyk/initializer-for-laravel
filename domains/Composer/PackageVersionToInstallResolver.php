<?php

namespace Domains\Composer;

use Composer\IO\NullIO;
use Composer\Package\BasePackage;
use Composer\Package\Version\VersionSelector;
use Composer\Repository\CompositeRepository;
use Composer\Repository\PlatformRepository;
use Composer\Repository\RepositoryFactory;
use Composer\Repository\RepositorySet;
use Illuminate\Support\Collection;

class PackageVersionToInstallResolver
{
    private ?VersionSelector $versionSelector;

    /**
     * @param ComposerDependency[]|Collection $packages
     */
    public function resolve(Collection $packages): Collection
    {
        $versionSelector = $this->versionSelector();

        return $packages->map(function (ComposerDependency $package) use ($versionSelector) {
            $candidate = $versionSelector->findBestCandidate(
                packageName: $package->packageId(),
                targetPackageVersion: $package->versionConstraint(),
            );
            $version = $versionSelector->findRecommendedRequireVersion($candidate);

            return [$candidate, $version];
        });
    }

    private function versionSelector(): VersionSelector
    {
        if ($this->versionSelector !== null) {
            $this->versionSelector = new VersionSelector(
                $this->repositorySet(),
                new PlatformRepository(),
            );
        }

        return $this->versionSelector;
    }

    private function repositorySet(): RepositorySet
    {
        $set = new RepositorySet();
        $set->addRepository($this->repos());

        return $set;
    }

    private function repos(): CompositeRepository
    {
        return new CompositeRepository(array_merge(
            array(new PlatformRepository),
            RepositoryFactory::defaultRepos(new NullIO())
        ));
    }
}
