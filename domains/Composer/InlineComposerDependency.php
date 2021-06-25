<?php

namespace Domains\Composer;

class InlineComposerDependency extends ComposerDependency
{
    public function __construct(
        private string $id,
        private string $name = '',
        private string $description = '',
        private string $href = '',
        private bool $isDevDependency = false,
    ) { }

    function id(): string
    {
        return $this->id;
    }

    function packageId(): string
    {
        return $this->id;
    }

    function name(): string
    {
        return $this->name;
    }

    function description(): string
    {
        return $this->description;
    }

    public function href(): ?string
    {
        return $this->href;
    }

    public function isDevDependency(): bool
    {
        return $this->isDevDependency;
    }
}
