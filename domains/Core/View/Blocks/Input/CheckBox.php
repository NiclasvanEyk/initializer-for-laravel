<?php

namespace Domains\Core\View\Blocks\Input;

use Domains\Core\View\Blocks\Block;

class CheckBox extends Block
{
    public function __construct(
        private readonly string $id,
        private readonly string $heading,
        private readonly ?string $name = null,
        private readonly ?string $href = null,
        private readonly ?string $tags = null,
        private readonly ?bool $checked = null,
        private readonly ?bool $readonly = null,
    ) {
    }

    public function render(): string
    {
        // TODO: Implement render() method.
    }
}
