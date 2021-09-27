<?php

namespace Domains\Composer;

class FlushException extends \Exception
{
    public function __construct(string $path)
    {
        parent::__construct(
            "Could write adjusted composer.json contents to '$path'!",
        );
    }
}
