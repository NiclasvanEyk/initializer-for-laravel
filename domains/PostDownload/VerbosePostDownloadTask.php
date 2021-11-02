<?php

namespace Domains\PostDownload;

/**
 * A {@link PostDownloadTask} where {@link PostDownloadTask::shell} is too
 * verbose to display it to the user directly.
 *
 * For most tasks we show the user directly what gets executed. Sometimes this
 * makes sense, sometimes it can be a bit verbose or distracting. If this is the
 * case, implement this interface to display the contents of
 * {@link VerbosePostDownloadTask::shellDescription()} instead of
 * {@link PostDownloadTask::shell} when running the task.
 */
interface VerbosePostDownloadTask
{
    /**
     * Short description of what the script is doing.
     */
    public function shellDescription(): string;
}
