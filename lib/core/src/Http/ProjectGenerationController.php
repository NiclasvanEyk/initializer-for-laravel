<?php

namespace InitializerForLaravel\Core\Http;

use Domains\CreateProjectForm\Sections\Metadata;
use Illuminate\Http\Request;
use InitializerForLaravel\Core\Configuration\ConfigurationResolver;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;

class ProjectGenerationController
{
    public function __invoke(
        Request $request,
        ConfigurationResolver $configurationResolver,
        Metadata $metadata,
        ProjectGenerator $generator,
    )
    {
        $configuration = $configurationResolver->resolveFrom($request);
        $archive = $generator->generate($configuration);

        return $archive->outputAsSymfonyResponse("$metadata->projectName.zip");
    }
}
