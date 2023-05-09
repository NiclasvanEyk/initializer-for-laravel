<?php

namespace App\Initializer;

use App\Initializer\Configuration as LaravelConfiguration;
use App\Initializer\ProjectAdjustments\AddPackageInstallationSteps;
use App\Initializer\ProjectAdjustments\AddEnvironmentPreparationScript;
use App\Initializer\ProjectAdjustments\RequireComposerPackages;
use App\Initializer\ProjectAdjustments\SetDotEnvExampleParameters;
use InitializerForLaravel\Composer\Initializer\Actions\FillComposerMetadata;
use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use InitializerForLaravel\Core\Project;
use function collect;

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
    $project = Project::from($this->templateStorage);

    $included = $configuration->evaluate(LaravelConfiguration::sections());
    $included = collect($included)->keyBy('id')->all();

    return $this
      ->adjustments
      ->apply([
        // We will fill the name, vendor, etc. based on what was
        // provided in the form.
        FillComposerMetadata::class,
        // Then we'll require the current versions of the chosen
        // packages.
        RequireComposerPackages::class,
        // This creates a script that installs Laravel Sail with the
        // chosen services, installs all composer dependencies
        AddEnvironmentPreparationScript::class,
        // After all dependencies are installed, this script runs
        // additional package setup steps, such as running
        // `passport:install` or compiling javascript.
        AddPackageInstallationSteps::class,
        // Many packages set their configuration parameters only in the
        // `.env` file. That is fine for the person installing the
        // package, but for everybody else who clones the repo,
        // important environment variables are missing without any
        // indication which.
        SetDotEnvExampleParameters::class,
      ])
      ->to($project, $included);
  }
}
