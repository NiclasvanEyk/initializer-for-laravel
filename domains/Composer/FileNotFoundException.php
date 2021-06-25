<?php

namespace Domains\Composer;

class FileNotFoundException extends \Exception
{
    public function __construct(string $path)
    {
        parent::__construct("File '$path' does not exist!");
    }
}
