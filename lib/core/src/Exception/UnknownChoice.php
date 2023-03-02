<?php

namespace InitializerForLaravel\Core\Exception;

use Exception;

final class UnknownChoice extends Exception
{
    public function __construct(string $choice)
    {
        parent::__construct("Unknown choice '$choice'!");
    }
}
