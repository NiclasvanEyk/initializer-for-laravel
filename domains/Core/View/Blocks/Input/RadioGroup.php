<?php

namespace Domains\Core\View\Blocks\Input;

use Domains\Core\View\Blocks\Block;

class RadioGroup extends Block
{
    /**
     * @param  string  $id
     * @param  list<RadioGroupOption>  $options
     */
    public function __construct(
        private readonly string $id,
        private readonly array $options,
    ) {
    }

    public function render(): string
    {
        // TODO: Implement render() method.
    }
}
