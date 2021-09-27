<?php

namespace Domains\PostDownload\Tasks;

use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;

class StartSail implements PostDownloadTaskGroup, PostDownloadTask
{
    public function __construct(private string $sail) { }

    public function title(): string
    {
        return "Start Laravel Sail";
    }

    public function tasks(): array
    {
        return [$this];
    }

    public function shell(): string
    {
        return "$this->sail up -d";
    }
}
