<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

use Domains\Composer\ComposerDependency;

class S3Driver extends ComposerDependency
{

    function id(): string
    {
        return "flysystem-aws";
    }

    function packageId(): string
    {
        return "league/flysystem-aws-s3-v3";
    }

    function name(): string
    {
        return "Amazon Simple Storage Service (S3)";
    }

    function description(): string
    {
        // Was inlined to be able to use links.
        return '';
    }

    public function href(): ?string
    {
        return "https://aws.amazon.com/s3";
    }

    public function needsToBeInstalledWithAllDependencies(): bool
    {
        return true;
    }

    public function versionConstraint(): ?string
    {
        return "^1.0.0";
    }
}
