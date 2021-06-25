<?php


namespace App\Dependencies\Laravel;


class Breeze extends FirstPartyPackage
{
    function description(): string
    {
        return 'A minimal, simple implementation of all of Laravel\'s '
            . 'authentication features, including login, registration, '
            . 'password reset, email verification, and password confirmation.';
    }

    public function href(): string
    {
        return 'https://laravel.com/docs/starter-kits#laravel-breeze';
    }
}
