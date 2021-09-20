<?php

namespace Tests\Feature\Domains\ProjectTemplate;

use Domains\Packagist\Models\Package;
use Domains\Packagist\Models\PackageDist;

class Laravel862Package extends Package
{
    public function __construct()
    {
        parent::__construct(
            name: 'laravel/laravel',
            version: 'v8.6.2',
            dist: new PackageDist(
                type: 'zip',
                url: 'https://api.github.com/repos/laravel/laravel/zipball/4f8a0f35fabd8603fb756122bf820719a259ac9b',
                reference: '4f8a0f35fabd8603fb756122bf820719a259ac9b',
            )
        );
    }
}
