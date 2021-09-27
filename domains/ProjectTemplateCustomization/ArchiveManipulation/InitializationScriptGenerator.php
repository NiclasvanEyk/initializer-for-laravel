<?php

namespace Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\PostDownload\PostDownloadTaskGroupCreator;
use Domains\PostDownload\PostInitializationLinkResolver;
use Illuminate\Contracts\View\Factory;

class InitializationScriptGenerator
{
    public function __construct(
        private Factory                        $view,
        private PostDownloadTaskGroupCreator   $postDownloadTaskGroupCreator,
        private PostInitializationLinkResolver $postInitializationLinkResolver,
    ) { }

    public function render(CreateProjectForm $form): string
    {
        return $this->view->make('template::initialize', [
            'groups' => $this->postDownloadTaskGroupCreator->fromForm($form),
            'links' => $this->postInitializationLinkResolver->links($form),
            'initializationScript' => $this->scriptName(),
        ])->render();
    }

    public function scriptName(): string
    {
        return 'initialize';
    }
}
