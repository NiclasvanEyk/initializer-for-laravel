<?php

namespace Domains\Core\View\Blocks\Builders;

final class CheckBoxGroup
{
    public function __construct(
        private readonly string $id,
        private readonly string $heading,
        private readonly array $tags,
        private readonly array $options,
    ) {
    }

    public function checkBox(): self
    {
    }

    public function build(): \Domains\Core\View\Blocks\Input\CheckBoxGroup
    {
        return new \Domains\Core\View\Blocks\Input\CheckBoxGroup(
            $this->id,
            $this->heading,
            $this->tags,
            $this->options,
        );
    }
}
