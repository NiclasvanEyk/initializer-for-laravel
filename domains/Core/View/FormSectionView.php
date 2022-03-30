<?php

namespace Domains\Core\View;

use Domains\Core\View\Blocks\Block;
use Domains\Core\View\Blocks\Input\CheckBox;
use Domains\Core\View\Blocks\Input\CheckBoxGroup;
use Domains\Core\View\Blocks\Paragraph;

final class FormSectionView
{
    /** @var list<Block> */
    private array $blocks = [];

    public function __construct(
        public readonly string $headline,
        public readonly string $icon,
    ) {
    }

    public function render(): string
    {
        return "";
    }

    public function paragraph(string $content): self {
        $this->blocks[] = new Paragraph($content);
        return $this;
    }

    public function checkBox(string $id, string $heading, ?string $name = null, ?string $href = null, ?string $tags = null, ?bool $checked = null, ?bool $readonly = null): self
    {
        $this->blocks[] = new CheckBox($id, $heading, $name, $href, $tags, $checked, $readonly);
        return $this;
    }

    public function checkBoxGroup(string $id, string $heading, array $options): self
    {
        $this->blocks[] = new CheckBoxGroup($id, $options);
        return $this;
    }
}
