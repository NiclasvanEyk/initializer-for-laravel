<?php

namespace Domains\Laravel\Sail;

class Selenium extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'selenium';

    function id(): string
    {
        return self::REPOSITORY_KEY;
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
