<?php

namespace Domains\Packagist;

use Throwable;

class PackageNotFoundException extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
