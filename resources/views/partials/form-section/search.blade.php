@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;
    use Domains\Laravel\ComposerPackages\Packages\Scout;
    use Domains\Laravel\RelatedPackages\Infrastructure\AlgoliaSearch;
    use Domains\Laravel\Sail\MeiliSearch;

    $scoutDriverParameter = P::SCOUT_DRIVER;

    $default = old($scoutDriverParameter, request(
        $scoutDriverParameter,
        ScoutDriverOption::default(),
    ));

    $scout = new Scout();

    $customDriver = ScoutDriverOption::CUSTOM;

    $meiliSearch = new MeiliSearch();
    $meiliSearchDriver = ScoutDriverOption::MEILISEARCH;

    $algolia = new AlgoliaSearch();
    $algoliaSearchDriver = ScoutDriverOption::ALGOLIA;

    $customSearchDriver = ScoutDriverOption::CUSTOM;
@endphp

<x-form-section name="Search">
    <x-slot name="description">
        <p class="mb-2">
            <x-link href="https://laravel.com/docs/scout">Laravel Scout</x-link>
            provides a simple, driver based solution for adding full-text search
            to your Eloquent models. Using model observers, Scout will
            automatically keep your search indexes in sync with your Eloquent
            records.
        </p>

        <p>
            Currently, Scout ships with Algolia and MeiliSearch drivers.
            Writing custom drivers is simple, so you are also free to extend
            Scout with your own search implementations.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.search />
    </x-slot>

    <x-form-control.group
        heading="Driver"
        href="https://laravel.com/docs/scout#driver-prerequisites"
        x-data="{scoutDriver: '{{ $default }}'}"
    >
        <x-radio-option-none
            name="{{ $scoutDriverParameter }}"
            model="scoutDriver"
        />

        <x-radio-option
            :id="$customDriver"
            model="scoutDriver"
            name="{{ $scoutDriverParameter }}"
            label="Custom"
            href="https://laravel.com/docs/scout#custom-engines"
        >
            You are installing or building your own driver implementation.
        </x-radio-option>

        <x-radio-option
            :id="$meiliSearchDriver"
            model="scoutDriver"
            name="{{ $scoutDriverParameter }}"
            label="{{ $meiliSearch->name() }}"
            href="{{ $meiliSearch->href() }}"
        >
            {{ $meiliSearch->description() }}

            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-radio-option>

        <x-radio-option
            :id="$algoliaSearchDriver"
            model="scoutDriver"
            name="{{ $scoutDriverParameter }}"
            label="{{ $algolia->name() }}"
            href="{{ $algolia->href() }}"
        >
            {{ $algolia->description() }}
        </x-radio-option>
    </x-form-control.group>
</x-form-section>