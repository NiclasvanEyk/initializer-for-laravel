<?php

namespace Domains\ProjectTemplateCustomization\PostDownload;

/**
 * A single step that is part of a {@link PostDownloadTaskGroup}
 */
interface PostDownloadTask
{
    /**
     * Shell script automating the task.
     */
    public function shell(): string;
}
