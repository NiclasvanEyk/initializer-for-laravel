<?php

namespace Domains\Laravel\Sail;

use Domains\CreateProjectForm\Components\Logo;

interface DatabaseOption
{
    function id(): string;
    function sailId(): string;
    function name(): string;
    function description(): string;
    function href(): string;
    function logo(): Logo;
}
