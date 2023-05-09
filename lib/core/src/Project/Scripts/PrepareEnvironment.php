<?php

namespace InitializerForLaravel\Core\Scripts;

use Domains\PostDownload\PostDownloadTaskGroup;

/**
 * This script prepares an environment in that the project can be initialized.
 *
 * This can include requiring packages, spawning docker containers, or booting
 * up databases.
 */
final class PrepareEnvironment
{
    /**
     * @param  PostDownloadTaskGroup[]  $tasks
     */
    public function __construct(public array $tasks = [])
    {
    }
}
