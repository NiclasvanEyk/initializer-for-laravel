<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\Configuration\Option;
use App\Initializer\ProjectAdjustment;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Composer\Initializer\PackageInstaller;
use InitializerForLaravel\Composer\Installation\InstallationInstructions;
use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Project;
use function collect;
use function data_get;

readonly final class RequireComposerPackages implements ProjectAdjustment
{
    public function __construct(
        private ComposerPackageMetadata $metadata,
        private PackageInstaller $installer
    ) {
    }

    public function apply(Project $project, array $options): void
    {
        $this->installer->install(
            $project,
            $this->metadata->phpVersion,
            $this->packagesToInstall($options)
        );
    }

    function packagesToInstall(array $options): array
    {
        return collect($options)
            ->flatMap(fn (Option $option) => $option->dependencies)
            ->filter(function (Dependency $dependency) {
                return $dependency->packageManager === Dependency::COMPOSER;
            })
            ->map(fn (Dependency $dependency) => new InstallationInstructions(
                package: $dependency->id,
                versionConstraint: data_get($dependency->options, 'version'),
                isDevDependency: data_get($dependency->options, 'dev', false),
            ))
            ->all();
    }
}
