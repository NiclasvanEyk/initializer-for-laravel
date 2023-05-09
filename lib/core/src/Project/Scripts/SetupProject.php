<?php

namespace InitializerForLaravel\Core\Scripts;

use Domains\PostDownload\PostDownloadTaskGroup;

final class SetupProject
{
    /**
     * @param  PostDownloadTaskGroup[]  $tasks
     */
    public function __construct(public array $tasks = [])
    {
    }
}
