<?php

namespace Domains\PostDownload;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\ComposerPackages\Packages\Horizon;
use Domains\Laravel\ComposerPackages\Packages\Telescope;
use Domains\Laravel\Sail\Mailhog;
use Domains\Laravel\Sail\MeiliSearch;
use Domains\Laravel\Sail\MinIO;
use Domains\ProjectTemplateCustomization\Resolver\ComposerPackagesToInstallResolver;
use Domains\ProjectTemplateCustomization\Resolver\SailServiceResolver;

class PostInitializationLinkResolver
{
    public function __construct(
        private SailServiceResolver $sailServiceResolver,
        private ComposerPackagesToInstallResolver $packagesToInstallResolver,
    ) {
    }

    /**
     * @return PostInitializationLink[]
     */
    public function links(CreateProjectForm $form): array
    {
        $services = $this->sailServiceResolver->resolveFor($form);
        $packages = $this->packagesToInstallResolver->resolveFor($form);

        $links = [new PostInitializationLink('Your Application')];

        if ($services->contains(fn ($it) => $it instanceof Mailhog)) {
            $links[] = new PostInitializationLink(
                title: 'Preview Emails via Mailhog',
                base: 'http://localhost:8025',
            );
        }

        if ($services->contains(fn ($it) => $it instanceof MeiliSearch)) {
            $links[] = new PostInitializationLink(
                title: 'MeiliSearch Administration Panel',
                base: 'http://localhost:7700',
            );
        }

        if ($services->contains(fn ($it) => $it instanceof MinIO)) {
            $links[] = new PostInitializationLink(
                title: 'MinIO Administration Panel',
                base: 'http://localhost:9000',
            );
        }

        if ($packages->contains(fn ($it) => $it instanceof Telescope)) {
            $links[] = new PostInitializationLink(
                title: 'Laravel Telescope',
                href: '/telescope',
            );
        }

        if ($packages->contains(fn ($it) => $it instanceof Horizon)) {
            $links[] = new PostInitializationLink(
                title: 'Laravel Horizon',
                href: '/horizon',
            );
        }

        return $links;
    }
}
