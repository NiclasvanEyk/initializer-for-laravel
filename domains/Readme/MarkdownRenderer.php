<?php

namespace Domains\Readme;

use function collect;

/**
 * A small utility to render small pieces of text in Markdown.
 */
class MarkdownRenderer
{
    public function h1(string $text): string
    {
        return "# $text";
    }

    public function h2(string $text): string
    {
        return "## $text";
    }

    public function h3(string $text): string
    {
        return "### $text";
    }

    public function link(string $text, string $href): string
    {
        return "[$text]($href)";
    }

    public function bold(string $text): string
    {
        return "**$text**";
    }

    public function code(string $text): string
    {
        return "`$text`";
    }

    public function codeBlock(string $text, string $language): string
    {
        return "```$language"
            .PHP_EOL
            .$text
            .PHP_EOL
            .'```';
    }

    public function listItem(string $text): string
    {
        return "- $text";
    }

    /**
     * @param  iterable<int,string>  $items
     */
    public function list(iterable $items): string
    {
        return collect($items)
            ->map(fn (string $item) => $this->listItem($item))
            ->join(PHP_EOL);
    }
}
