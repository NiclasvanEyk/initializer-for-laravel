<?php

namespace Domains\Laravel\Sail;

class Selenium extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'selenium';

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'Selenium';
    }

    public function description(): string
    {
        return 'Automated browser tests.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#laravel-dusk';
    }
}
