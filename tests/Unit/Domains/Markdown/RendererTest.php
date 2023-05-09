<?php

namespace Tests\Unit\Domains\Markdown;

use Domains\Readme\MarkdownRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Domains\Readme\MarkdownRenderer
 */
class RendererTest extends TestCase
{
    private MarkdownRenderer $renderer;

    protected function setUp(): void
    {
        $this->renderer = new MarkdownRenderer();
    }

    /**
     * @covers ::h1
     *
     * @test
     */
    public function it_renders_h1(): void
    {
        $this->assertEquals('# foo', $this->renderer->h1('foo'));
    }

    /**
     * @covers ::h2
     *
     * @test
     */
    public function it_renders_h2(): void
    {
        $this->assertEquals('## foo', $this->renderer->h2('foo'));
    }

    /**
     * @covers ::h3
     *
     * @test
     */
    public function it_renders_h3(): void
    {
        $this->assertEquals('### foo', $this->renderer->h3('foo'));
    }

    /**
     * @covers ::link
     *
     * @test
     */
    public function it_renders_links(): void
    {
        $this->assertEquals(
            '[Google](https://google.com)',
            $this->renderer->link('Google', 'https://google.com'),
        );
    }

    /**
     * @covers ::bold
     *
     * @test
     */
    public function it_renders_bold_text(): void
    {
        $this->assertEquals('**foo**', $this->renderer->bold('foo'));
    }

    /**
     * @covers ::code
     *
     * @test
     */
    public function it_renders_inline_code(): void
    {
        $this->assertEquals('`foo`', $this->renderer->code('foo'));
    }

    /**
     * @covers ::codeBlock
     *
     * @test
     */
    public function it_renders_code_blocks(): void
    {
        $expected = <<<'EXPECTED'
        ```php
        $foo = "bar";
        ```
        EXPECTED;

        $this->assertEquals(
            trim($expected),
            $this->renderer->codeBlock('$foo = "bar";', 'php'),
        );
    }

    /**
     * @covers ::listItem
     *
     * @test
     */
    public function it_renders_list_items(): void
    {
        $this->assertEquals('- foo', $this->renderer->listItem('foo'));
    }

    /**
     * @covers ::list
     *
     * @test
     */
    public function it_renders_lists(): void
    {
        $expected = <<<'EXPECTED'
        - one
        - two
        - three
        EXPECTED;

        $this->assertEquals(
            trim($expected),
            $this->renderer->list(['one', 'two', 'three']),
        );
    }
}
