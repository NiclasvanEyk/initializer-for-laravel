<?php

namespace InitializerForLaravel\Core\Configuration;

class Paragraph
{
    use SimpleDataClass;

    public function __construct(public readonly string $text)
    {
    }
}
