<?php


namespace App\Sail;


class Mailhog extends SailConfigurationOption
{
    function id(): string
    {
        return 'mail-mailhog';
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
