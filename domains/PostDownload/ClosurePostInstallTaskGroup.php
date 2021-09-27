<?php

namespace Domains\PostDownload;

class ClosurePostInstallTaskGroup implements PostDownloadTaskGroup
{
    /**
     * @param  string  $theTitle
     * @param  callable  $theTasks
     */
    public function __construct(
        private string $theTitle,
        private $theTasks,
    ) {
    }

    public function title(): string
    {
        return $this->theTitle;
    }

    public function tasks(): array
    {
        return call_user_func($this->theTasks);
    }
}
