<?php

namespace Domains\Composer\ProjectTemplateCustomization;

use Domains\Composer\ComposerJsonFile;
use Domains\Composer\PackageVersionToInstallResolver;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\ProjectTemplateCustomization\Resolver\ComposerPackagesToInstallResolver;
use Illuminate\Support\Collection;

/**
 * Responsible for making adjustments to the <pre>composer.json</pre> file.
 */
class ComposerJsonGenerator
{
    public function __construct(
        private ComposerPackagesToInstallResolver $packagesToInstallResolver,
    ) {
    }

    public function render(
        CreateProjectForm $form,
        ComposerJsonFile $composerJson,
    ): string {
        $composerJson = $this->syncMetaData($form->metadata, $composerJson);
        $composerJson = $this->requirePackages($form, $composerJson);
        $composerJson = $this->removeUnnecessaryScripts($composerJson);

        return $composerJson->prettyContents();
    }

    protected function syncMetaData(
        Metadata $metadata,
        ComposerJsonFile $composerJson,
    ): ComposerJsonFile {
        return $composerJson
            ->setFullProjectName($metadata->fullName())
            ->setDescription($metadata->description)
            ->setPhpVersion($metadata->phpVersion);
    }

    protected function requirePackages(
        CreateProjectForm $form,
        ComposerJsonFile $composerJson
    ): ComposerJsonFile {
        $packagesWithVersion = $this->resolvePackagesWithVersion($form);

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

        return $composerJson;
    }

    protected function resolvePackagesWithVersion(
        CreateProjectForm $form,
    ): Collection {
        $phpVersion = $form->metadata->phpVersion;
        $versionResolver = new PackageVersionToInstallResolver($phpVersion);
        $packages = $this->packagesToInstallResolver->resolveFor($form);

        return $versionResolver->resolve($packages);
    }

    protected function removeUnnecessaryScripts(
        ComposerJsonFile $composerJson,
    ): ComposerJsonFile {
        // These two are only important when you install laravel/laravel
        // via composer create-project. Since this is not the case, they
        // just distract the end user (at least I don't know when all of
        // them get executed by just looking at their names), so we remove
        // them.
        return $composerJson
            ->removeScript('post-root-package-install')
            ->removeScript('post-create-project-cmd');
    }
}
