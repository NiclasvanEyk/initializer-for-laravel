<?php

namespace Domains\Readme;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\InitializationScript\InitializationScriptGenerator;
use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\PostDownloadTaskGroupCreator;
use Domains\PostDownload\PostInitializationLinkResolver;
use Domains\Readme\Support\Str;
use Illuminate\Contracts\View\Factory;
use InitializerForLaravel\Core\Project;

use function collect;
use function route;

/**
 * Generates a nice README.md at the project root.
 */
class ReadmeGenerator
{
    private string $template = 'template::README';

    public function __construct(
        private Factory $view,
        private MarkdownRenderer $markdown,
        private InitializationScriptGenerator $initializationScriptGenerator,
        private PostInitializationLinkResolver $postInitializationLinkResolver,
    ) {
    }

    public function render(Project $project): string
    {
        return $this->view->make($this->template, [
            'title' => $project->name,
            'description' => $project->description,
            'links' => $this->postInitializationLinkResolver->links($form),
            'initializerUrl' => route('root'),
            'initializationScript' => $this->initializationScriptGenerator->scriptName(),
            'markdown' => $this->markdown,
        ])->render();
    }
}
