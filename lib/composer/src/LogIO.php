<?php

namespace InitializerForLaravel\Composer;

use Composer\IO\NullIO;
use Illuminate\Support\Facades\Log;

class LogIO extends NullIO
{
    public function isVerbose(): bool
    {
        return true;
    }

    public function isVeryVerbose(): bool
    {
        return true;
    }

    public function isDebug(): bool
    {
        return true;
    }

    public function write($messages, $newline = true, $verbosity = self::NORMAL): void
    {
        if (is_array($messages)) {
            $messages = implode(PHP_EOL, $messages);
        }

        Log::info($messages);
    }

    public function writeError($messages, $newline = true, $verbosity = self::NORMAL): void
    {
        if (is_array($messages)) {
            $messages = implode(PHP_EOL, $messages);
        }

        Log::info($messages);
    }
}
