@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\ComposerPackages\Packages;

    $mailhog = new \Domains\Laravel\Sail\Mailhog();
    $mailhogParameter = P::USES_MAILHOG;
    $usesMailhog = checkbox_checked(P::USES_MAILHOG, default: true);

    $telescope = new Packages\Telescope();
    $telescopeParameter = P::USES_TELESCOPE;
    $usesTelescope = checkbox_checked($telescopeParameter);

    $envoy = new Packages\Envoy();
    $envoyParameter = P::USES_ENVOY;
    $usesEnvoy = checkbox_checked($envoyParameter);
@endphp

<x-form-section name="Development Tools">
    <x-slot name="description">
       <p>
           Debugging your application can be a pain, but Laravel provides some
           additional tools to make it a bit easier.
           <x-link :href="$telescope->href()">Laravel Telescope</x-link>
           provides a nice dashboard of all events, requests, jobs and
           everything else happening in your application and
           <x-link :href="$mailhog->href()">Mailhog</x-link> enables you to
           preview your outgoing mails locally, instead of sending them.
       </p>

        <p>
            If you find yourself ssh-ing into your remote servers and running
            the same tasks over and over, you should give
            <x-link :href="$envoy->href()">Laravel Envoy</x-link> a try. It
            enables you to define sets of commands locally using the already
            familiar Blade syntax.
        </p>
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
    />
    <x-first-party-package.option
        :id="$envoyParameter"
        :checked="$usesEnvoy"
        :package="$envoy"
    />
</x-form-section>