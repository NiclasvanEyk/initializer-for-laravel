<?php

namespace Domains\PostDownload\Tasks;

use Domains\PostDownload\PostDownloadTaskGroup;

class SetupFrontend implements PostDownloadTaskGroup
{
    public function __construct(private string $npm) { }

    public function title(): string
    {
        return "Setup frontend";
    }

    public function tasks(): array
    {
        return [
            "$this->npm install",
            "$this->npm run dev",
        ];
    }
}
