@php
    use Domains\Laravel\ComposerPackages\Packages;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $fortify = new Packages\Fortify();
    $fortifyParameter = P::USES_FORTIFY;
    $usesFortify = checkbox_checked($fortifyParameter);

    $sanctum = new Packages\Sanctum();

    $passport = new Packages\Passport();
    $passportParameter = P::USES_PASSPORT;
    $usesPassport = checkbox_checked($passportParameter);

    $socialite = new Packages\Socialite();
    $socialiteParameter = P::USES_SOCIALITE;
    $usesSocialite = checkbox_checked($socialiteParameter);
@endphp

<x-form-section name="Authentication">
    <x-slot name="description">
        Depending on which starter kit you choose, it might make sense to
        install additional packages. If you are unsure whether you need them or
        not, have a look at the
        <x-link
            href="https://laravel.com/docs/authentication#ecosystem-overview"
        >authentication ecosystem overview</x-link> section of the official
        documentation, which explains everything well.
    </x-slot>

    <x-slot name="icon">
        <x-icons.lock />
    </x-slot>

    <x-first-party-package.option
        :id="$fortifyParameter"
        :package="$fortify"
        :checked="$usesFortify"
    />

    <x-first-party-package.option
        :id="$sanctum->id()"
        :package="$sanctum"
        :checked="true"
        :hasValue="false"
        :readonly="true"
    />

    <x-first-party-package.option
        :id="$passportParameter"
        :package="$passport"
        :checked="$usesPassport"
    />

    <x-first-party-package.option
        :id="$socialiteParameter"
        :package="$socialite"
        :checked="$usesSocialite"
    />
</x-form-section>