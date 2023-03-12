<?php

namespace InitializerForLaravel\Core\Http;

use Domains\CreateProjectForm\Sections\Metadata;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use InitializerForLaravel\Composer\Initializer\ComposerPackageMetadata;
use InitializerForLaravel\Core\Configuration\Configurator;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Project;

readonly class ProjectGenerationController
{
    public function __construct(
        private Configurator $configurator,
        private ProjectGenerator $generator,
        private Container $container
    ) {
    }

    public function __invoke(Request $request, ComposerPackageMetadata $metadata): Project
    {
        $this->container->instance(ComposerPackageMetadata::class, $metadata);

        $configuration = $this->configurator->buildFrom($request);
        $project = $this->generator->generate($configuration);

        return $project;
    }
}
