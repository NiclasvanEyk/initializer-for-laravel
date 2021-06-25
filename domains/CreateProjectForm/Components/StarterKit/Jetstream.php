<?php

namespace Domains\CreateProjectForm\Components\StarterKit;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

use Domains\Laravel\ComposerPackages\Packages\Jetstream as JetstreamPackage;
use Domains\Laravel\StarterKit\JetstreamFrontend;
use Domains\Laravel\StarterKit\StarterKit;
use Illuminate\View\Component;

class Jetstream extends Component
{
    public JetstreamPackage $jetstream;
    public string $jetstreamParam = StarterKit::JETSTREAM;
    public string $jetstreamTeams = P::USES_JETSTREAM_TEAMS;
    public string $jetstreamFrontend = P::JETSTREAM_FRONTEND;
    public string $livewire = JetstreamFrontend::LIVEWIRE;
    public string $inertia = JetstreamFrontend::INERTIA;
    public bool $jetstreamTeamsChecked;
    public string $jetstreamFrontendChosen;
    public string $activeAlpineCondition;

    public function __construct(public string $model)
    {
        $this->jetstream = new JetstreamPackage(
            false,
            false,
            new JetstreamFrontend(JetstreamFrontend::LIVEWIRE),
        );
        $this->jetstreamTeamsChecked = request()->has(P::USES_JETSTREAM_TEAMS);
        $this->jetstreamFrontendChosen = request(
            P::JETSTREAM_FRONTEND,
            JetstreamFrontend::LIVEWIRE,
        );
        $this->activeAlpineCondition = "$this->model == '$this->jetstreamParam'";
    }

    public function render()
    {
        return view('starter-kit::jetstream');
    }
}
