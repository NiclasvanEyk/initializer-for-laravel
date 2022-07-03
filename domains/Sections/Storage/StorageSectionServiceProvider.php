<?php

namespace Domains\Sections\Storage;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\S3Driver;
use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem\SftpDriver;
use Domains\Laravel\Sail\MinIO;
use Domains\Platform\Contracts\ProvidesComposerDependencies;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class StorageSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices, ProvidesComposerDependencies
{
    public function sailServices(CreateProjectForm $form): Collection {
        $services = new Collection();

        if ($form->storage->usesMinIO) {
            $services->add(new MinIO());
        }

        return $services;
    }

    public function composerDependencies(CreateProjectForm $form): Collection
    {
        $packages = [];

        if ($form->storage->usesMinIO || $form->storage->usesS3) {
            $packages[] = new S3Driver();
        }

        if ($form->storage->usesSftp) {
            $packages[] = new SftpDriver();
        }

        return new Collection($packages);
    }
}
