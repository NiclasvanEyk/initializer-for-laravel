<?php

namespace Domains\Laravel\StarterKit;

use Domains\Composer\ComposerDependency;

class Breeze extends StarterKit
{
    public function __construct(
        public BreezeFrontend $frontend,
        private bool $usesPest,
        private bool $usesDarkMode,
    ) {
        parent::__construct(StarterKit::BREEZE);
    }

    public function composerPackage(): ?ComposerDependency
    {
        return new \Domains\Laravel\ComposerPackages\Packages\Breeze(
            frontend: $this->frontend,
            usesPest: $this->usesPest,
            usesDarkMode: $this->usesDarkMode,
        );
    }
}
