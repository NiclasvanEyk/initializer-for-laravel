<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class FtpDriver extends ComposerDependency
{
    public function id(): string
    {
        return 'flysystem-ftp';
    }

    public function packageId(): string
    {
        return 'league/flysystem-ftp';
    }

    public function name(): string
    {
        return 'FTP';
    }

    public function description(): string
    {
        return '';
    }

    public function href(): ?string
    {
        return 'https://laravel.com/docs/filesystem#ftp-driver-configuration';
    }

    public function versionConstraint(): ?string
    {
        return '^3.0';
    }
}
