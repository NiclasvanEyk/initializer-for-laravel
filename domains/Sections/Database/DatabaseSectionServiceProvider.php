<?php

namespace Domains\Sections\Database;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\Laravel\RelatedPackages\Database\DoctrineDbal;
use Domains\Platform\Contracts\ProvidesComposerDependencies;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class DatabaseSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices, ProvidesComposerDependencies
{
    public function sailServices(CreateProjectForm $form): Collection {
        return new Collection($form->database->database);
    }

    public function composerDependencies(CreateProjectForm $form): Collection
    {
        if ($form->database->useDbal) {
            return new Collection([new DoctrineDbal()]);
        }

        return new Collection();
    }
}
