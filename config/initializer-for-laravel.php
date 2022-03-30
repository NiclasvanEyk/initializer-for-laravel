<?php

use Domains\FormSections as Sections;

return [

    /*
    |--------------------------------------------------------------------------
    | Form Sections
    |--------------------------------------------------------------------------
    |
    | This is where you can register all your form sections that your
    | initializer should present to the user.
    |
    */

    'form-sections' => [
        Sections\FileStorage\FileStorageFormSection::class,
    ],

];
