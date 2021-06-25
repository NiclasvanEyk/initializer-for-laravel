<?php

namespace App\Dependencies\Laravel;

class Jetstream extends FirstPartyPackage
{
    function description(): string
    {
        return 'A polished and feature-rich implementation for your '
            . 'application\'s login, registration, email verification, '
            . 'two-factor authentication, session management, API, and '
            . 'optional team management features.';
    }

    public function href(): string
    {
        return 'https://jetstream.laravel.com';
    }
}
