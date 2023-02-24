<?php

namespace Domains\CreateProjectForm\Components\StarterKit;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\Laravel\ComposerPackages\Packages\Breeze as BreezePackage;
use Domains\Laravel\StarterKit\BreezeFrontend;
use Domains\Laravel\StarterKit\StarterKit;
use Illuminate\View\Component;

class Breeze extends Component
{
    public BreezePackage $breeze;
    public string $breezeParam = StarterKit::BREEZE;
    public string $breezeFrontend = P::BREEZE_FRONTEND;
    public string $useDarkMode = P::USES_BREEZE_DARK_MODE;
    public string $breezeFrontendChosen;
    public string $blade = BreezeFrontend::BLADE;
    public string $react = BreezeFrontend::REACT;
    public string $vue = BreezeFrontend::VUE;
    public string $api = BreezeFrontend::API;
    public string $activeAlpineCondition;

    public function __construct(public string $model)
    {
        $this->breeze = new BreezePackage(
            new BreezeFrontend(BreezeFrontend::BLADE),
            false,
        );
        $this->breezeFrontendChosen = old(
            P::BREEZE_FRONTEND,
            request(
                P::BREEZE_FRONTEND,
                BreezeFrontend::BLADE,
            ),
        );
        $this->activeAlpineCondition = "$this->model == '$this->breezeParam'";
    }

    public function render()
    {
        return view('starter-kit::breeze');
    }
}
