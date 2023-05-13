<?php

namespace Domains\PostDownload\Tasks;

use Domains\PostDownload\PostDownloadTaskGroup;

class InstallDevcontainer implements PostDownloadTaskGroup
{
    public function __construct(private string $artisan)
    {
    }

    public function title(): string
    {
        return 'Publish the default .devcontainer configuration';
    }

    public function tasks(): array
    {
        return [
            "$this->artisan sail:install --devcontainer --no-interaction",
        ];
    }
}

namespace Domains\PostDownload\Tasks;
