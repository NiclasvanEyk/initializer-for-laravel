<?php

namespace Domains\Composer;

use Composer\Factory;
use Composer\IO\NullIO;
use Composer\Package\Version\VersionSelector;
use Composer\Repository\CompositeRepository;
use Composer\Repository\PlatformRepository;
use Composer\Repository\RepositoryFactory;
use Composer\Repository\RepositorySet;
use Exception;
use Illuminate\Support\Collection;

/**
 * Determines the current versions of composer packages should be installed.
 *
 * After source-diving Composer/Composer, it seems that the
 * {@link VersionSelector} is used to determine the version when using
 * `compsoser install` / `composer require`. This also enables constraining the
 * version beforehand, e.g. if {@link ComposerDependency::versionConstraint()}
 * is implemented.
 */
class PackageVersionToInstallResolver
{
    private ?VersionSelector $versionSelector = null;

    /**
     * @param  Collection|ComposerDependency[]  $packages
     * @return Collection|PackageWithResolvedVersion[]
     */
    public function resolve(Collection $packages): Collection
    {
        $versionSelector = $this->versionSelector();

        return $packages->map(function (ComposerDependency $package) use ($versionSelector) {
            $candidate = $versionSelector->findBestCandidate(
                packageName: $package->packageId(),
                targetPackageVersion: $package->versionConstraint(),
            );

            if ($candidate === false) {
                throw new Exception('Could find an installation candidate for package!', [
                    'package' => $package->packageId(),
                ]);
            }

            $version = $versionSelector->findRecommendedRequireVersion($candidate);

            return new PackageWithResolvedVersion($package, $version);
        });
    }

    private function versionSelector(): VersionSelector
    {
        if ($this->versionSelector === null) {
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
        // Composer needs this to work correctly, but it is sometimes not
        // available in containers.
        if (! getenv('HOME')) {
            putenv('HOME='.storage_path('app'));
        }

        return new CompositeRepository(array_merge(
            [new PlatformRepository],
            RepositoryFactory::defaultRepos(
                new NullIO(),
                Factory::createConfig(new NullIO(), storage_path('app')),
            ),
        ));
    }
}
