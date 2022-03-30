<?php

namespace Domains\Core\View\Blocks;

class Paragraph extends Block
{
    public function __construct(readonly string $content)
    {
    }

    public function render(): string
    {
        return $this->content;
    }
}
