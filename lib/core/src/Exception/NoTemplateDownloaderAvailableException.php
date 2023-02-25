<?php

namespace InitializerForLaravel\Core\Exception;

use Exception;
use InitializerForLaravel\Core\Contracts\TemplateDownloader;
use Throwable;

final class NoTemplateDownloaderAvailableException extends Exception
{
    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        $downloaderInterface = TemplateDownloader::class;

        parent::__construct(
            "Bind an instance of $downloaderInterface to an implementation in order to use this command!",
            $code,
            $previous
        );
    }
}
