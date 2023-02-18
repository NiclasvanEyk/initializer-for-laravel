<?php

namespace Domains\Laravel\RelatedPackages\Search;

use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use InitializerForLaravel\Composer\ComposerDependency;

class Algolia extends ComposerDependency
{
    public function id(): string
    {
        return ScoutDriver::ALGOLIA->value;
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
