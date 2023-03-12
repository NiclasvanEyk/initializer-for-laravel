<?php

namespace InitializerForLaravel\Composer\Initializer;

use InitializerForLaravel\Composer\ComposerJsonFile;
use InitializerForLaravel\Composer\Installation\PackageVersionToInstallResolver;
use InitializerForLaravel\Composer\Installation\VersionSelectorFactory;
use InitializerForLaravel\Composer\PhpVersion;
use InitializerForLaravel\Core\Project;

readonly final class PackageInstaller
{
    public function __construct(
        private VersionSelectorFactory $versionSelectorFactory
    ) {
    }

    public function install(Project $project, PhpVersion $php, array $packages): void
    {
        $packagesWithVersion = $this
            ->packageInstaller($php)
            ->resolve(collect($packages));

        ComposerProject::from($project)->editComposerJson(
            function (ComposerJsonFile $composerJson) use ($packagesWithVersion) {
                foreach ($packagesWithVersion as $resolved) {
                    if ($resolved->isDevDependency) {
                        $composerJson->requireDev(
                            $resolved->package,
                            $resolved->version,
                        );
                    } else {
                        $composerJson->require(
                            $resolved->package,
                            $resolved->version,
                        );
                    }
                }
            }
        );
    }

    private function packageInstaller(PhpVersion $php): PackageVersionToInstallResolver
    {
        $selector = $this->versionSelectorFactory->build($php->value);
        return new PackageVersionToInstallResolver($selector);
    }
}
