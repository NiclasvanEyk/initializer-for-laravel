<?php

namespace App\Initializer\FooBar;

readonly final class LaravelOptionBuilder
{
    public static function make()
    {
        return new self();
    }

    public function build(): LaravelOption
    {

    }
}
