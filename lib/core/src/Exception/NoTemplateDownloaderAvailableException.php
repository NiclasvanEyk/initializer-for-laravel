<?php

namespace InitializerForLaravel\Core\Exception;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Contracts\TemplateRetriever;
use Throwable;

final class NoTemplateDownloaderAvailableException extends Exception
{
    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        $downloaderInterface = TemplateRetriever::class;

        parent::__construct(
            "Bind an instance of $downloaderInterface to an implementation in order to use this command!",
            $code,
            $previous
        );
    }

    /**
     * @throws NoTemplateDownloaderAvailableException
     */
    public static function throwWhenApplicable(
        BindingResolutionException $exception
    ): void {
        if (Str::contains($exception->getMessage(), TemplateRetriever::class)) {
            throw new self(previous: $exception);
        }
    }
}
