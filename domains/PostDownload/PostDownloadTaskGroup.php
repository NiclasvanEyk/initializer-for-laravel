<?php

namespace Domains\PostDownload;

/**
 * A set of steps that share a common goal, which need to be executed once the
 * user has downloaded the project archive.
 */
interface PostDownloadTaskGroup
{
    public function title(): string;

    /** @return PostDownloadTask[]|string[] */
    public function tasks(): array;
}
