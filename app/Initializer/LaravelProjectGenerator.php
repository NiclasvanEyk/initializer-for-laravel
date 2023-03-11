<?php

namespace App\Initializer;

use App\Initializer\ProjectAdjustments\AddSailServices;
use App\Initializer\ProjectAdjustments\SetDotEnvExampleParameters;
use InitializerForLaravel\Composer\Initializer\Actions\SetPackageMetadata;
use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use InitializerForLaravel\Core\Project\AdjustmentPipelineBuilder;
use InitializerForLaravel\Core\Project\Project;

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

        return $this
            ->adjustments
            ->apply([
                SetPackageMetadata::class,
                SetDotEnvExampleParameters::class,
                AddSailServices::class,
            ])
            ->to($project, $configuration);
    }
}
