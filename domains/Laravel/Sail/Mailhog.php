<?php

namespace Domains\Laravel\Sail;

class Mailhog extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'mailpit';

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'Mailpit';
    }

    public function description(): string
    {
        return 'Intercept and preview your emails locally.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#previewing-emails';
    }
}
