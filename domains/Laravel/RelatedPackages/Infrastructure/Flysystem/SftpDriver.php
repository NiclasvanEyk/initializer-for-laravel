<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use InitializerForLaravel\Composer\ComposerDependency;

class SftpDriver extends ComposerDependency
{
    public function id(): string
    {
        return 'flysystem-sftp';
    }

    public function packageId(): string
    {
        return 'league/flysystem-sftp-v3';
    }

    public function name(): string
    {
        return 'SFTP';
    }

    public function description(): string
    {
        return 'While FTP is supported out of the box, you need to check this '
            .'option to be able to use SFTP storage.';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/filesystem#sftp-driver-configuration';
    }

    public function versionConstraint(): ?string
    {
        return '~3.0';
    }
}
