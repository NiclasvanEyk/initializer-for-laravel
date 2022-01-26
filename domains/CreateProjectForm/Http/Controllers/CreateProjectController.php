<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Domains\Statistics\StatisticsService;
ª
class CreateProjectController
{
    public function __invoke(
        CreateProjectRequest $request,
        ProjectTemplateCustomizer $builder,
        Application $app,
        StatisticsService $statistics,
    ): Response {
        $form = $request->buildForm();
        $name = $form->metadata->projectName;
        $archive = $builder->build($form);

        $app->terminating(fn () => rescue(fn () => $statistics->record($request)));

        return $archive->outputAsSymfonyResponse("$name.zip");
    }
}
