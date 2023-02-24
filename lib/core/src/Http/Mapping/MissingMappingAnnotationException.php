<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use Exception;
use ReflectionParameter;

class MissingMappingAnnotationException extends Exception
{
    public function __construct(ReflectionParameter $parameter)
    {
        $fqn = "$$parameter->name";

        parent::__construct(
            "$fqn is missing an attribute that tells me how to map its properties from a HTTP request!"
            .'Annotate it with either '.Option::class.' or '.Choice::class.'.'
        );
    }
}
