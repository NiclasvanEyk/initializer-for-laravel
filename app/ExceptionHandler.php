<?php

namespace App;

use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class ExceptionHandler extends Handler
{
    public function register()
    {
        $this->reportable(function (Throwable $exception): void
        {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        });
    }
}
