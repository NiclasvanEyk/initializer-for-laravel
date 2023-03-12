<?php

namespace InitializerForLaravel\Composer\Initializer\Actions;

use Illuminate\Support\Collection;
use InitializerForLaravel\Composer\ComposerDependency;
use InitializerForLaravel\Composer\ComposerJsonFile;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Composer\Initializer\ComposerProject;
use InitializerForLaravel\Composer\Installation\PackageVersionToInstallResolver;
use InitializerForLaravel\Composer\Installation\VersionSelectorFactory;
use InitializerForLaravel\Core\Project;

abstract readonly class RequireComposerPackages
{
    public function __construct(
        private VersionSelectorFactory $versionSelectorFactory,
        private ComposerPackageMetadata $metadata
    ) {
    }

    /**
     * @param array $options
     * @return Collection<ComposerDependency>
     */
    abstract function packagesToInstall(array $options): Collection;

    public function packageInstaller(): PackageVersionToInstallResolver
    {
        $selector = $this->versionSelectorFactory->build($this->metadata->phpVersion);
        return new PackageVersionToInstallResolver($selector);
    }

    public function apply(Project $project, array $options): void
    {
        $packages = $this->packagesToInstall($options);
        $packagesWithVersion = $this->packageInstaller()->resolve($packages);

        ComposerProject::from($project)->editComposerJson(
            function (ComposerJsonFile $composerJson) use ($packagesWithVersion) {
                foreach ($packagesWithVersion as $packageWithVersion) {
                    if ($packageWithVersion->package->isDevDependency()) {
                        $composerJson->requireDev(
                            $packageWithVersion->package->packageId(),
                            $packageWithVersion->version,
                        );
                    } else {
                        $composerJson->require(
                            $packageWithVersion->package->packageId(),
                            $packageWithVersion->version,
                        );
                    }
                }
            }
        );
    }
}
