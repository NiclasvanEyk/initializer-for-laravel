<?php

namespace Domains\InitializationScript\View\Components\Initialize;

use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\PostDownloadTaskRenderer;
use Illuminate\View\Component;

/**
 * Renders a {@link PostDownloadTaskGroup} to the terminal.
 *
 * This means it will be explained to the user what's happening in this step, as
 * well as executing the actual steps of this group.
 */
class TaskGroup extends Component
{
    public function __construct(
        public PostDownloadTaskGroup $group,
        public PostDownloadTaskRenderer $renderer,
    ) {
    }

    public function render(): string
    {
        return <<<'BLADE'
        <x-shell::banner :title="$group->title()" />
        echo '';

        @foreach($group->tasks() as $task)
        {!! $renderer->announce($task) !!}
        {!! $renderer->execute($task) !!}
        @endforeach
        BLADE;
    }
}
