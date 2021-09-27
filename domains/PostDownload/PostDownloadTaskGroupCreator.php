<?php

namespace Domains\PostDownload;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\PostDownload\Tasks\MigrateDatabase;
use Domains\PostDownload\Tasks\SetupFrontend;
use Domains\PostDownload\Tasks\SetupPackages;
use Domains\PostDownload\Tasks\SetupSail;
use Domains\PostDownload\Tasks\StartSail;
use Domains\ProjectTemplateCustomization\Resolver\ComposerPackagesToInstallResolver;
use Domains\ProjectTemplateCustomization\Resolver\SailServiceResolver;

class PostDownloadTaskGroupCreator
{
    public function __construct(
        private ComposerPackagesToInstallResolver $composerPackages,
        private SailServiceResolver $sailServices,
    ) { }

    /**
     * @return PostDownloadTaskGroup[]
     */
    public function fromForm(CreateProjectForm $form): array
    {
        $sail = "./vendor/bin/sail";
        $artisan = "$sail exec -T -u sail \"laravel.test\" php artisan";
        $npm = "$sail exec -T \"laravel.test\" npm";

        $dependencies = $this->composerPackages->resolveFor($form);

        return [
            // Install all composer dependencies
            new SetupSail(
                $this->sailServices->resolveFor($form),
                $form->metadata->phpVersion,
            ),
            // start the sail container
            new StartSail($sail),
            // run package:install for all that actually need them
            ...(new SetupPackages($artisan, $dependencies))->tasks(),
            // migrate the db (might be unnecessary, but just to be sure)
            new MigrateDatabase($artisan),
            // npm stuff
            new SetupFrontend($npm),
        ];
    }
}
