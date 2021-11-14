<?php

namespace Domains\Composer;

use Composer\Factory;
use Composer\IO\NullIO;
use Composer\Package\Package;
use Composer\Package\Version\VersionSelector;
use Composer\Repository\CompositeRepository;
use Composer\Repository\PlatformRepository;
use Composer\Repository\RepositoryFactory;
use Composer\Repository\RepositorySet;

class VersionSelectorFactory
{
    public function build(string $phpVersion): VersionSelector
    {
        return new VersionSelector(
            $this->repositorySet(),
            new PlatformRepository([
                new Package('php', $phpVersion, $phpVersion),
            ]),
        );
    }

    private function repositorySet(): RepositorySet
    {
        $set = new RepositorySet();
        $set->addRepository($this->repos());

        return $set;
    }

    private function repos(): CompositeRepository
    {
        // Composer needs this to work correctly, but it is sometimes not
        // available in containers.
        if (! getenv('HOME')) {
            putenv('HOME='.storage_path('app'));
        }

        return new CompositeRepository(array_merge(
            [new PlatformRepository()],
            RepositoryFactory::defaultRepos(
                new NullIO(),
                Factory::createConfig(new NullIO(), storage_path('app')),
            ),
        ));
    }
}
