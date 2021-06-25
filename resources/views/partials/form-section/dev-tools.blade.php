@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\ComposerPackages\Packages;


    $mailhog = new \Domains\Laravel\Sail\Mailhog();
    $mailhogParameter = P::USES_MAILHOG;
    $usesMailhog = old(P::USES_MAILHOG, request(P::USES_MAILHOG), true);

    $telescope = new Packages\Telescope();
    $telescopeParameter = P::USES_TELESCOPE;
    $usesTelescope = old($telescopeParameter, request()->has($telescopeParameter));

    $envoy = new Packages\Envoy();
    $envoyParameter = P::USES_ENVOY;
    $usesEnvoy = old($envoyParameter, request($envoyParameter), false);
@endphp

<x-form-section name="Development Tools">
    <x-slot name="description">
        Laravel
        If you want to give your users the ability to execute full-text search
        queries, which go beyond what a simple <code>where</code> SQL clause
        could achieve, this section might be for you.
    </x-slot>

    <x-slot name="icon">
        <x-icons.code />
    </x-slot>


    <x-first-party-package.option
        :id="$telescopeParameter"
        :checked="$usesTelescope"
        :package="$telescope"
    />
    <x-sail.option
        :name="$mailhogParameter"
        :checked="$usesMailhog"
        :option="$mailhog"
        :checked="true"
    />
    <x-first-party-package.option
        :id="$envoyParameter"
        :checked="$usesEnvoy"
        :package="$envoy"
    />
</x-form-section>
