<?php

namespace App\Initializer\FooBar;

final class LaravelOption
{
    public function __construct(
        public $sailServices,
        public $composerPackages,
        public $npmPackages,
        public $readmeLinks,
        public
    )
    {
    }
}
