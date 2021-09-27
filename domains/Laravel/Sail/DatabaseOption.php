<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;

interface DatabaseOption
{
    public function id(): string;

    public function sailId(): string;

    public function name(): string;

    public function description(): string;

    public function href(): string;

    public function logo(): Logo;
}
