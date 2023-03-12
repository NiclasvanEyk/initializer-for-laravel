<?php

namespace App\Initializer;

use InitializerForLaravel\Core\Project;

readonly final class LaravelProject
{
    public function __construct(private Project $project)
    {
    }

    public function mutateComposerJson(callable $mutate)
    {

    }

    public function applyMetadata()
    {

    }
}
