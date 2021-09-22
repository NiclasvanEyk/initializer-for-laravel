@php
    use Domains\Laravel\ComposerPackages\Packages\Dusk;
    use Domains\Laravel\Sail\Selenium;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $dusk = new Dusk();
    $duskParameter = P::USES_DUSK;
    $usesDusk = checkbox_checked($duskParameter);

    $pest = new \Domains\Laravel\RelatedPackages\Community\Pest();
    $pestParameter = P::USES_PEST;
    $usesPest = checkbox_checked($pestParameter);
@endphp

<x-form-section name="Testing">
    <x-slot name="description">
        <p>
            Laravel ships with
            <x-link href="https://phpunit.de/">PHPUnit</x-link> out of the box,
            but some might prefer using the newer
            <x-link href="https://pestphp.com/">Pest</x-link> library. If you
            enable this option, the tests included with your starter will also
            use Pest.
        </p>

        <p>
            If feature and unit tests are not enough, you can go one step
            further and test your websites using a real browser using
            <x-link href="https://www.selenium.dev">Selenium</x-link> and
            <x-link :href="$dusk->href()">Laravel Dusk</x-link>.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.beaker />
    </x-slot>

    <div class="space-y-4">
        <x-first-party-package.option
            :id="$duskParameter"
            :package="$dusk"
            :checked="$usesDusk"
        >
            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-first-party-package.option>

        <x-form-control.checkbox
            id="{{ $pestParameter }}"
            heading="{{ $pest->name() }}"
            href="{{ $pest->href() }}"
            :checked="$usesPest"
        >
            {{ $pest->description() }}

            <x-slot name="tags">
                <x-tags.community />
            </x-slot>
        </x-form-control.checkbox>
    </div>
</x-form-section>