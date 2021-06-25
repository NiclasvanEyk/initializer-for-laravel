<?php

namespace Domains\ProjectTemplateCustomization\PostDownload;

use Domains\Composer\ComposerDependency;
use Illuminate\Support\Collection;

class RequireComposerDependencies implements PostDownloadTaskGroup
{
    /**
     * @param ComposerDependency[]|Collection $dependencies
     */
    public function __construct(
        private Collection  $dependencies,
        private string $composer,
    ) { }

    public function title(): string
    {
        return "Require Composer dependencies";
    }

    private function dependencies(
        bool $dev,
        bool $withAllDependencies,
    ): Collection {
        return $this->dependencies
            ->filter(function (ComposerDependency $dependency) use ($dev, $withAllDependencies) {
                $devRequirement =
                       ( $dev &&  $dependency->isDevDependency())
                    || (!$dev && !$dependency->isDevDependency());
                $depsRequirement =
                       ( $withAllDependencies &&  $dependency->needsToBeInstalledWithAllDependencies())
                    || (!$withAllDependencies && !$dependency->needsToBeInstalledWithAllDependencies());

                return $devRequirement && $depsRequirement;
            });
    }

    private function dependencyInstallList(bool $dev, bool $withAllDependencies): string
    {
        return $this->dependencies($dev, $withAllDependencies)
            ->map(function (ComposerDependency $dependency) {
                return $dependency->constraintsVersion()
                    ? "{$dependency->packageId()}:{$dependency->versionConstraint()}"
                    : $dependency->packageId();
            })
            ->join(' ');
    }

    private function require(bool $dev, bool $withAllDependencies): string
    {
        return collect([
            $this->composer,
            'require',
            $dev ? '--dev' : '',
            $withAllDependencies ? '--with-all-dependencies' : '',
            $this->dependencyInstallList($dev, $withAllDependencies)
        ])->filter()->join(' ');
    }

    public function tasks(): array
    {
        $tasks = [];
        $permutations = [
            [false, false],
            [false, true],
            [true, false],
            [true, true],
        ];

        // We need to do several passes here, as e.g. the aws sdk needs to be
        // installed with certain flags and others are dev-dependencies.
        //
        // If Composer supported specifying all these options in one require
        // statement, we would not need to do multiple passes here.
        // Alternatively we could explore resolving the versions on the server
        // side, which would vastly speed up the local installation.
        foreach ($permutations as [$dev, $withAllDependencies]) {
            if ($this->dependencies($dev, $withAllDependencies)->isNotEmpty()) {
                $tasks[] = $this->require($dev, $withAllDependencies);
            }
        }

        return $tasks;
    }
}
