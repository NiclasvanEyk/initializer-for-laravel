<?php

namespace Domains\PostDownload\Tasks;

use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\PostDownloadTaskGroup;
use Domains\PostDownload\VerbosePostDownloadTask;

class AdjustPermissions implements PostDownloadTaskGroup, PostDownloadTask, VerbosePostDownloadTask
{
    public function title(): string
    {
        return 'Adjust Permissions';
    }

    public function tasks(): array
    {
        return [$this];
    }

    public function shellDescription(): string
    {
        return 'sudo chown -R $USER: .';
    }

    public function shell(): string
    {
        return <<<'SHELL'
            if sudo -n true 2>/dev/null; then
                sudo chown -R $USER: .
            else
                echo -e "Please provide your password so we can make some final adjustments to your application's permissions."
                echo ""
                sudo chown -R $USER: .
            fi
        SHELL;
    }
}
