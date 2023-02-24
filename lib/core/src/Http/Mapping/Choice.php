<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Choice
{
    public function __construct(public ?string $name = null)
    {
    }
}
