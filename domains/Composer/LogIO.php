<?php

namespace Domains\Composer;

use Composer\IO\NullIO;
use Illuminate\Support\Facades\Log;

class LogIO extends NullIO
{
    public function isVerbose()
    {
        return true;
    }

    public function isVeryVerbose()
    {
        return true;
    }

    public function isDebug()
    {
        return true;
    }

    public function write($messages, $newline = true, $verbosity = self::NORMAL)
    {
        if (is_array($messages)) {
            $messages = implode(PHP_EOL, $messages);
        }

        Log::info($messages);
    }

    public function writeError($messages, $newline = true, $verbosity = self::NORMAL)
    {
        if (is_array($messages)) {
            $messages = implode(PHP_EOL, $messages);
        }

        Log::info($messages);
    }
}
