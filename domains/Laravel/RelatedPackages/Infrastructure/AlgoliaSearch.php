<?php

namespace Domains\Laravel\RelatedPackages\Infrastructure;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\Sections\Scout\AlgoliaScoutDriver;

/**
 * @see AlgoliaScoutDriver
 */
class AlgoliaSearch extends ComposerDependency
{
    public function id(): string
    {
        return 'algolia';
    }

    public function packageId(): string
    {
        return 'algolia/algoliasearch-client-php';
    }

    public function name(): string
    {
        return 'Algolia';
    }

    public function description(): string
    {
        return 'Powerful, hosted search API to create fast and relevant search & discovery.';
    }

    public function href(): string
    {
        return 'https://www.algolia.com';
    }
}
