<?php

use InitializerForLaravel\Core\Storage\LocalTemplateStorage;

return [
    'storage' => [
        'driver' => LocalTemplateStorage::class,
        'options' => [
            'base' => storage_path('initializer-template')
        ],
    ],
];
