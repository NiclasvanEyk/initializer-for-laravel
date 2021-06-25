@php
    use Domains\Laravel\ComposerPackages\Packages;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $fortify = new Packages\Fortify();
    $fortifyParameter = P::USES_FORTIFY;
    $usesFortify = old($fortifyParameter, request()->has($fortifyParameter));

    $sanctum = new Packages\Sanctum();

    $passport = new Packages\Passport();
    $passportParameter = P::USES_PASSPORT;
    $usesPassport = old($passportParameter, request()->has($passportParameter));

    $socialite = new Packages\Socialite();
    $socialiteParameter = P::USES_SOCIALITE;
    $usesSocialite = old($socialiteParameter, request()->has($socialiteParameter));
@endphp

<x-form-section name="Starter Kit & Authentication">
    <x-slot name="description">
        Laravel provides a few
        <x-link href="https://laravel.com/docs/starter-kits">
            starter kits
        </x-link> for your application, which provide various authentication
        features out of the box.
    </x-slot>

    <x-slot name="icon">
        <x-icons.home />
    </x-slot>

    <x-starter-kit::selector />

    <div>
        {{-- This div just adds a little bit of space --}}
        &nbsp;
    </div>

    <p>
        Depending on which starter kit you choose, it might make sense to
        install additional packages. If you are unsure whether you need them or
        not, have a look at the
        <x-link
            href="https://laravel.com/docs/authentication#ecosystem-overview"
        >authentication ecosystem overview</x-link> section of the official
        documentation, which explains everything well.
    </p>

    <x-form-control.group
        heading="Additional Authentication Packages"
        href="https://laravel.com/docs/authentication#ecosystem-overview"
    >
        <div class="divide-y">
            <x-first-party-package.option
                :id="$fortifyParameter"
                :package="$fortify"
                :checked="$usesFortify"
                flush
            />

            <x-first-party-package.option
                :id="$sanctum->id()"
                :package="$sanctum"
                :checked="true"
                :hasValue="false"
                :readonly="true"
                flush
            />

            <x-first-party-package.option
                :id="$passportParameter"
                :package="$passport"
                :checked="$usesPassport"
                flush
            />

            <x-first-party-package.option
                :id="$socialiteParameter"
                :package="$socialite"
                :checked="$usesSocialite"
                flush
            />
        </div>
    </x-form-control.group>
</x-form-section>
