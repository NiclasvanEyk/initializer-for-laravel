<?php

namespace Domains\Sections\Search;

use Domains\Composer\InlineComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\Laravel\ComposerPackages\Packages\Scout;
use Domains\Laravel\RelatedPackages\Search\Algolia;
use Domains\Laravel\Sail\MeiliSearch;
use Domains\Platform\Contracts\ProvidesComposerDependencies;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class SearchSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices, ProvidesComposerDependencies
{
    public function sailServices(CreateProjectForm $form): Collection {
        $services = new Collection();

        if ($form->search->driver === ScoutDriver::MEILISEARCH) {
            $services->add(new MeiliSearch());
        }

        return $services;
    }

    public function composerDependencies(CreateProjectForm $form): Collection
    {
        return new Collection(match ($form->search->driver) {
            ScoutDriver::NONE => [],
            ScoutDriver::MEILISEARCH => [
                new Scout(),
                new InlineComposerDependency('meilisearch/meilisearch-php'),
                new InlineComposerDependency('http-interop/http-factory-guzzle'),
            ],
            ScoutDriver::ALGOLIA => [new Scout(), new Algolia()],
            ScoutDriver::DATABASE, ScoutDriver::CUSTOM => [new Scout()],
        });
    }
}
