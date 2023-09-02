<?php

namespace Domains\CreateProjectForm\Http\Controllers;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\ProjectTemplate\ProjectTemplateService;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Domains\Statistics\StatisticsService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CreateProjectController
{
    public function __construct(
        private readonly ProjectTemplateService $templateStorage,
        private readonly ProjectTemplateCustomizer $builder,
        private readonly Application $app,
        private readonly StatisticsService $statistics,
    ) {
    }

    public function __invoke(CreateProjectRequest $request): Response
    {
        $this->maybeUpdateTemplate();

        $form = $request->buildForm();
        $archive = $this->builder->build($form);

        $this->recordStatistics($request);

        $name = $form->metadata->projectName;

        return $archive->outputAsSymfonyResponse("$name.zip");
    }

    private function recordStatistics(CreateProjectRequest $request): void
    {
        $this->app->terminating(function () use ($request) {
            rescue(fn () => $this->statistics->record($request));
        });
    }

    private function maybeUpdateTemplate(): void
    {
        $this->app->terminating(function () {
            if (Cache::get('template-requires-check') === false) {
                return;
            }

            info('Checking if template needs an update triggered by a CreateProjectRequest...');
            if ($this->templateStorage->canBeUpdated()) {
                info('Updating template triggered by a CreateProjectRequest...');
                $this->templateStorage->update();
            }

            info("Don't check again for 24 hours...");
            Cache::set('template-requires-check', false, ttl: now()->addDays(1));
        });
    }
}
