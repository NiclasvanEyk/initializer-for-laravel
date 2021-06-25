<?php

namespace Domains\ProjectTemplateCustomization\PostDownload;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\ComposerPackages\ProvidesInstallationInstructions;
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
        $artisan = "$sail artisan";
        $composer = "$sail composer";
        $npm = "$sail npm";

        $dependencies = $this->composerPackages->resolveFor($form);

        return [
            new SetupSail(
                $this->sailServices->resolveFor($form),
                $form->metadata->phpVersion,
            ),
            new StartSail($sail),
            new RequireComposerDependencies($dependencies, $composer),
            ...(new SetupPackages($artisan, $dependencies))->tasks(),
            new MigrateDatabase($artisan),
            new SetupFrontend($npm),
        ];
    }
}
