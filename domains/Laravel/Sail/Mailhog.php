<?php


namespace Domains\Laravel\Sail;


class Mailhog extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'mailhog';

    function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    function name(): string
    {
        return 'Mailhog';
    }

    function description(): string
    {
        return 'Intercept and preview your emails locally.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#previewing-emails';
    }
}
