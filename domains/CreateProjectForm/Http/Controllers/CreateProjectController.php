<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CreateProjectController
{
    public function __invoke(
        CreateProjectRequest $request,
        ProjectTemplateCustomizer $builder,
    ): Response {
        $form = $request->buildForm();
        $name = $form->metadata->projectName;
        $archive = $builder->build($form);

        Log::info('Initialized project!', [
            'starter' => $form->authentication->starterKit->name,
            'database' => $form->database->database->id(),
        ]);

        return $archive->outputAsSymfonyResponse("$name.zip");
    }
}
