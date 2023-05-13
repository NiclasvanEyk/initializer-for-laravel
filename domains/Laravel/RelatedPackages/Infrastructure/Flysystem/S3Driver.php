<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class S3Driver extends ComposerDependency
{
    public function id() : string
    {
        return 'flysystem-aws';
    }

    public function packageId() : string
    {
        return 'league/flysystem-aws-s3-v3';
    }

    public function name() : string
    {
        return 'Amazon Simple Storage Service (S3)';
    }

    public function description() : string
    {
        // Was inlined to be able to use links.
        return '';
    }

    public function href() : ?string
    {
        return 'https://aws.amazon.com/s3';
    }

    public function needsToBeInstalledWithAllDependencies() : bool
    {
        return true;
    }

    public function versionConstraint() : ?string
    {
        return '^3.0';
    }
}