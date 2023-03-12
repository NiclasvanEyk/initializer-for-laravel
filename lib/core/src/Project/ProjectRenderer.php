<?php

namespace InitializerForLaravel\Core\Project;

use InitializerForLaravel\Core\Project;

/**
 * Generates files based on properties of the project.
 */
readonly final class ProjectRenderer
{
    public function render(Project $project): void
    {
        $this->generateInitializeScript($project);
        $this->generateReadme($project);
    }

    private function generateInitializeScript(Project $project): void
    {
        //
    }

    private function generateReadme(Project $project): void
    {
        //
    }
}
