<?php

namespace InitializerForLaravel\Core\Http;

use Domains\CreateProjectForm\Sections\Metadata;
use Illuminate\Http\Request;
use InitializerForLaravel\Core\Configuration\Configurator;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Project\Project;

readonly class ProjectGenerationController
{
    public function __construct(
        private Configurator $configurator,
        private ProjectGenerator $generator,
    ) {
    }

    public function __invoke(Request $request, Metadata $metadata): Project
    {
        $configuration = $this->configurator->buildFrom($request);
        $project = $this->generator->generate($configuration);

        return $project;
    }
}
