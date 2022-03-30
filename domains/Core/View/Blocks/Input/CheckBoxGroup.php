<?php

namespace Domains\Core\View\Blocks\Input;

use Domains\Core\View\Blocks\Block;

class CheckBoxGroup extends Block
{
    /**
     * @param string $id
     * @param list<CheckBox> $options
     */
    public function __construct(
        private readonly string $id,
        private readonly array $options,
        private readonly array $tags,
        private readonly array $options,
    ) {
    }

    public function render(): string
    {
        // TODO: Implement render() method.
    }
}
