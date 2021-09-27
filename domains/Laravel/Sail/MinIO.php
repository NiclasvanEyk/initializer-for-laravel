<?php

namespace Domains\Laravel\Sail;

class MinIO extends SailConfigurationOption
{
    const REPOSITORY_KEY = 'minio';

    public function id(): string
    {
        return self::REPOSITORY_KEY;
    }

    public function name(): string
    {
        return 'MinIO';
    }

    public function description(): string
    {
        return 'Amazon S3 API compatible file storage service. Useful if you '
            .'want to use local "cloud" storage, as it will be more similar '
            .' to your production environment than a local filesystem when '
            .'using S3.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/sail#file-storage';
    }
}
