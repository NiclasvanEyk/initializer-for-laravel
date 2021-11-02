<?php

namespace Domains\PostDownload\Tasks;

use Domains\PostDownload\PostDownloadTask;
use Domains\PostDownload\VerbosePostDownloadTask;

class WaitForDatabase implements PostDownloadTask, VerbosePostDownloadTask
{
    public function __construct(private string $artisan)
    {
    }

    public function shellDescription(): string
    {
        return 'Waiting for database to accept connections...';
    }

    public function shell(): string
    {
        return <<<SHELL
attempt=1;
maxAttempts=5;
sleepTime=5;
until $this->artisan tinker --execute 'try { DB::statement("select true"); echo("DB ready"); } catch (Throwable \$e) { exit(1); }' | grep -q "DB ready" || [ \$attempt -eq \$maxAttempts ]; do
    echo "Attempt \$attempt failed, retrying in \${sleepTime}s...";
    ((attempt=attempt+1));
    sleep \$sleepTime;
done

if [ "\$attempt" -eq "\$maxAttempts" ]; then
    echo "Could not connect to database after \$attempt attempts! Aborting...";
    exit 1;
fi

echo "Database ready!"
SHELL;
    }
}
