<?php

namespace App\Initializer;

use App\Initializer\Configuration as LaravelConfiguration;
use App\Initializer\ProjectAdjustments\AddSailServices;
use App\Initializer\ProjectAdjustments\RequireComposerPackages;
use App\Initializer\ProjectAdjustments\SetDotEnvExampleParameters;
use Illuminate\Contracts\Container\Container;
use InitializerForLaravel\Composer\Initializer\Actions\SetPackageMetadata;
use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use App\Initializer\AdjustmentPipelineBuilder;
use InitializerForLaravel\Core\Project;
use function collect;
use function config;

readonly final class LaravelProjectGenerator implements ProjectGenerator
{
    public function __construct(
        private TemplateStorage $templateStorage,
        private AdjustmentPipelineBuilder $adjustments,
    ) {
    }

    /**
     * @throws MissingTemplate
     */
    public function generate(Configuration $configuration): Project
    {
        $name = "TODO";
        $project = Project::from($this->templateStorage, name: $name);

        $included = $configuration->evaluate(LaravelConfiguration::sections());
        $included = collect($included)->keyBy('id')->all();

        return $this
            ->adjustments
            ->apply([
                SetPackageMetadata::class,
                RequireComposerPackages::class,
                AddSailServices::class,
                SetDotEnvExampleParameters::class,
            ])
            ->to($project, $included);
    }
}
