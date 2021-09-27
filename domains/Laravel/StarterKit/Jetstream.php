<?php

namespace Domains\Laravel\StarterKit;

use Domains\Composer\ComposerDependency;

class Jetstream extends StarterKit
{
    public function __construct(
        public JetstreamFrontend $frontend,
        public bool $usesPest,
        public bool $usesTeams,
    ) {
        parent::__construct(StarterKit::JETSTREAM);
    }

    public function composerPackage(): ?ComposerDependency
    {
        return new \Domains\Laravel\ComposerPackages\Packages\Jetstream(
            usesTeams: $this->usesTeams,
            usesPest: $this->usesPest,
            frontend: $this->frontend,
        );
    }
}
