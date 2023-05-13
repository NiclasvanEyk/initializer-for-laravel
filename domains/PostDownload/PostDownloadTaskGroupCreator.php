<?php

namespace Domains\PostDownload;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\StarterKit\Breeze;
use Domains\Laravel\StarterKit\BreezeFrontend;
use Domains\PostDownload\Tasks\AdjustPermissions;
use Domains\PostDownload\Tasks\MigrateDatabase;
use Domains\PostDownload\Tasks\SetupFrontend;
use Domains\PostDownload\Tasks\SetupPackages;
use Domains\PostDownload\Tasks\SetupSail;
use Domains\PostDownload\Tasks\StartSail;
use Domains\PostDownload\Tasks\InstallDevcontainer;
use Domains\ProjectTemplateCustomization\Resolver\ComposerPackagesToInstallResolver;
use Domains\ProjectTemplateCustomization\Resolver\NpmPackagesToInstallResolver;
use Domains\ProjectTemplateCustomization\Resolver\SailServiceResolver;

class PostDownloadTaskGroupCreator
{
    public function __construct(
        private ComposerPackagesToInstallResolver $composerPackages,
        private NpmPackagesToInstallResolver $npmPackages,
        private SailServiceResolver $sailServices,
    ) {
    }

    /**
     * @return PostDownloadTaskGroup[]
     */
    public function fromForm(CreateProjectForm $form): array
    {
        // When testing we need to pass the -T flag to docker-compose,
        // as it seems that GH Actions does not support TTYs yet.
        $testing = config('app.env') === 'testing';
        $sail = './vendor/bin/sail';
        $artisan = $testing
            ? "$sail exec -T -u sail \"laravel.test\" php artisan"
            : "$sail artisan";
        $npm = $testing
            ? "$sail exec -T \"laravel.test\" npm"
            : "$sail npm";

        $dependencies = $this->composerPackages->resolveFor($form);

        $tasks = [
            // Install all composer dependencies
            new SetupSail(
                sailServices: $this->sailServices->resolveFor($form),
                phpVersion: $form->metadata->phpVersion,
            ),
            new AdjustPermissions(),
            // start the sail container
            new StartSail($sail),
            new InstallDevcontainer($artisan),
            // run package:install for all that actually need them
            ...(new SetupPackages($artisan, $dependencies))->tasks(),
            // migrate the db (might be unnecessary, but just to be sure)
            new MigrateDatabase($artisan),
        ];

        if ($this->hasFrontend($form)) {
            $packages = $this->npmPackages->resolveFor($form);
            $tasks[] = new SetupFrontend($npm, $packages);
        }

        return $tasks;
    }

    private function hasFrontend(CreateProjectForm $form): bool
    {
        $starterKit = $form->authentication->starterKit;
        $usesBreezeApiStack = $starterKit instanceof Breeze
            && $starterKit->frontend->name === BreezeFrontend::API;

        return ! $usesBreezeApiStack;
    }
}
