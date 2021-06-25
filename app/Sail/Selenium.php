<?php

namespace App\Sail;

class Selenium extends SailConfigurationOption
{
    function id(): string
    {
        return 'testing-selenium';
    }

    function name(): string
    {
        return 'Selenium';
    }

    function description(): string
    {
        return 'Automated browser tests.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#laravel-dusk';
    }
}
