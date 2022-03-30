<?php

namespace Domains\Core\View\Blocks;

abstract class Block
{
    abstract public function render(): string;
}
