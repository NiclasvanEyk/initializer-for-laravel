<?php

namespace InitializerForLaravel\Core\Exception;

use Exception;

class MissingTemplate extends Exception
{
    public function __construct()
    {
        parent::__construct('No project template available!');
    }
}
