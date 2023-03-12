<?php

namespace InitializerForLaravel\Composer\Installation;

use Composer\Filter\PlatformRequirementFilter\IgnoreAllPlatformRequirementFilter;
use Composer\Package\Version\VersionSelector;
use Illuminate\Support\Collection;
use InitializerForLaravel\Composer\ComposerDependency;
use InitializerForLaravel\Composer\Installation\NoInstallationCandidateFoundException;
use InitializerForLaravel\Composer\Installation\ResolvedPackageVersion;

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
    public function __construct(private VersionSelector $versionSelector)
    {
    }

    /**
     * @param  Collection<int, InstallationInstructions>  $packages
     * @return Collection<int, ResolvedPackageVersion>
     */
    public function resolve(Collection $packages): Collection
    {
        return $packages->map(function (InstallationInstructions $install) {
            $candidate = $this->versionSelector->findBestCandidate(
                packageName: $install->package,
                targetPackageVersion: $install->versionConstraint,
                platformRequirementFilter: new IgnoreAllPlatformRequirementFilter(),
            );

            if ($candidate === false) {
                throw new NoInstallationCandidateFoundException($install);
            }

            $version = $this->versionSelector->findRecommendedRequireVersion($candidate);

            return new ResolvedPackageVersion(
                $install->package,
                $version,
                $install->isDevDependency,
            );
        });
    }
}
