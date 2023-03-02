<?php

namespace App\Initializer;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Contracts\ProjectGenerator;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Project\Project;

readonly final class LaravelProjectGenerator implements ProjectGenerator
{
    public function __construct(private TemplateStorage $templateStorage)
    {
    }

    public function generate(Configuration $configuration): Project
    {
        $project = Project::from($this->templateStorage);

        $this->adjustComposerJson();
        $this->addScriptsTo($project);
        $this->adjustConfiguration($project);

        return $project;
    }

    private function addScriptsTo(Project $project): void
    {

    }

    private function adjustConfiguration(Project $project)
    {

    }

    private function adjustComposerJson(): void
    {

    }
}
