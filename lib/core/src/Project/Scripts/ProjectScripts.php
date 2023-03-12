<?php

namespace InitializerForLaravel\Core\Scripts;

readonly final class ProjectScripts
{
    public PrepareEnvironment $prepareEnvironment;
    public SetupProject $setupProject;

    public function __construct()
    {
        $this->prepareEnvironment = new PrepareEnvironment();
        $this->setupProject = new SetupProject();
    }
}
