<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Symfony\Component\HttpFoundation\Response;

class CreateProjectController
{
    public function __invoke(
        CreateProjectRequest      $request,
        ProjectTemplateCustomizer $builder,
    ): Response {
        $form = $request->buildForm();
        $name = $form->metadata->projectName;
        $archive = $builder->build($form);

        return $archive->outputAsSymfonyResponse("$name.zip");
    }
}
