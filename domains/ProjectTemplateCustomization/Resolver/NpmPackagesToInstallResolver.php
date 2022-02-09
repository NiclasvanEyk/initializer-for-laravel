<?php

namespace Domains\ProjectTemplateCustomization\Resolver;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use Domains\Laravel\NpmPackages\LaravelEcho;
use Domains\Laravel\RelatedPackages\Broadcasting\PusherJs;
use Domains\Laravel\RelatedPackages\Broadcasting\Soketi;
use Domains\Laravel\StarterKit\Breeze;
use Domains\Laravel\StarterKit\BreezeFrontend;
use Domains\NodeJs\NpmDependency;
use Illuminate\Support\Collection;

class NpmPackagesToInstallResolver
{
    /** @return Collection<int, NpmDependency> */
    public function resolveFor(CreateProjectForm $form): Collection
    {
        /** @var Collection<int, NpmDependency> $packages */
        $packages = new Collection();
        $starterKit = $form->authentication->starterKit;

        if ($starterKit instanceof Breeze && $starterKit->frontend->name === BreezeFrontend::API) {
            // We don't install packages for breeze with the api stack, since we
            // assume that no frontend scaffolding is present
            return $packages;
        }

        if ($form->broadcasting->channel !== null) {
            $packages->add(new PusherJs());
            $packages->add(new LaravelEcho());
        }

        if ($form->broadcasting->channel === BroadcastingChannelOption::SOKETI) {
            $packages->add(new Soketi());
        }

        return $packages;
    }
}
