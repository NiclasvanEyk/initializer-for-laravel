<?php

namespace App\Initializer\ProjectAdjustments;

use App\Initializer\Configuration\Option;
use InitializerForLaravel\Composer\ComposerDependency;
use InitializerForLaravel\Composer\Initializer\Actions\RequireComposerPackages as Base;
use InitializerForLaravel\Core\Configuration\Dependency;
use function collect;

readonly final class RequireComposerPackages extends Base
{
    function packagesToInstall(array $options): array
    {
        return collect($options)
            ->flatMap(fn (Option $option) => $option->dependencies)
            ->filter(fn (Dependency $dependency) => $dependency->packageManager === Dependency::COMPOSER)
            ->map(fn (Dependency $dependency) => new ComposerDependency())
            ->all();
    }
}
