<?php

namespace App\Sail;

class MinIO extends SailConfigurationOption
{
    function id(): string
    {
        return 'storage-minio';
    }

    function name(): string
    {
        return 'MinIO';
    }

    function description(): string
    {
        return 'Amazon S3 API compatible file storage service. Useful if you '
            . 'want to use local "cloud" storage, as it will be more similar '
            . ' to your production environment than a local filesystem when '
            . 'using S3.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#file-storage';
    }
}
