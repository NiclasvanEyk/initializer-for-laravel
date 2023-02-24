<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
readonly final class Option
{
    public function __construct(public ?string $name = null)
    {
    }
}
