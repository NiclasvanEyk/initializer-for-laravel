<?php

namespace InitializerForLaravel\Core\Contracts;

interface Option
{
    public function id(): string;
    public function name(): string;
    public function description(): string;
    public function link(): ?string;
    /** @return string[] */
    public function tags(): array;
}
