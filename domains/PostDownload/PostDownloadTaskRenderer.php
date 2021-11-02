<?php

namespace Domains\PostDownload;

/**
 * Responsible for turning {@link PostDownloadTask}s into their respective shell
 * code and announcing them to the user.
 */
class PostDownloadTaskRenderer
{
    /**
     * Announce the task to the user.
     */
    public function announce(PostDownloadTask|VerbosePostDownloadTask|string $task): string
    {
        $description = match(true) {
            $task instanceof VerbosePostDownloadTask => $task->shellDescription(),
            $task instanceof PostDownloadTask => $task->shell(),
            default => (string) $task,
        };

        return "echo {$this->escape($description)}";
    }

    private function escape(string $shell): string
    {
        return escapeshellarg($shell);
    }

    /**
     * Return the shell string that should be executed.
     */
    public function execute(PostDownloadTask|string $task): string
    {
        return is_string($task) ? $task : $task->shell();
    }
}
