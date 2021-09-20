<?php

namespace Domains\Laravel\StarterKit;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\Support\Enum\EmulatesEnum;

abstract class StarterKit
{
    use EmulatesEnum;

    const LARAVEL = 'laravel';
    const BREEZE = 'breeze';
    const JETSTREAM = 'jetstream';

    public function __construct(public string $name) { }

    abstract function composerPackage(): ?ComposerDependency;

    public static function fromRequest(CreateProjectRequest $request): Laravel|Breeze|Jetstream
    {
        return match($request->starter) {
            StarterKit::LARAVEL => new Laravel(),
            StarterKit::BREEZE => new Breeze(
                frontend: new BreezeFrontend(
                    $request->get(P::BREEZE_FRONTEND, BreezeFrontend::BLADE)
                ),
                usesPest: $request->get(P::USES_PEST, false),
            ),
            StarterKit::JETSTREAM => new Jetstream(
                frontend: new JetstreamFrontend(
                    $request->get(P::JETSTREAM_FRONTEND, JetstreamFrontend::LIVEWIRE),
                ),
                usesPest: $request->get(P::USES_PEST, false),
                usesTeams: $request->get(P::USES_JETSTREAM_TEAMS, false),
            ),
            default => new Laravel(),
        };
    }
}
