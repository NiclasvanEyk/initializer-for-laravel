<?php

namespace Domains\InitializationScript;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\PostDownload\PostDownloadTaskGroupCreator;
use Domains\PostDownload\PostDownloadTaskRenderer;
use Domains\PostDownload\PostInitializationLinkResolver;
use Illuminate\Contracts\View\Factory;

class InitializationScriptGenerator
{
    public function __construct(
        private Factory $view,
        private PostDownloadTaskGroupCreator $postDownloadTaskGroupCreator,
        private PostDownloadTaskRenderer $taskRenderer,
        private PostInitializationLinkResolver $postInitializationLinkResolver,
    ) {
    }

    public function render(CreateProjectForm $form): string
    {
        return $this->view->make('template::initialize', [
            'taskRenderer' => $this->taskRenderer,
            'groups' => $this->postDownloadTaskGroupCreator->fromForm($form),
            'links' => $this->postInitializationLinkResolver->links($form),
            'initializationScript' => $this->scriptName(),
            'githubIssueLink' => "https://github.com/NiclasvanEyk/initializer-for-laravel/issues/new",
        ])->render();
    }

    public function scriptName(): string
    {
        return 'initialize';
    }
}
