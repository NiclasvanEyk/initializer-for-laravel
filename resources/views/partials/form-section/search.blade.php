@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;use Domains\Laravel\ComposerPackages\Packages\Scout;use Domains\Laravel\RelatedPackages\Search\Algolia;use Domains\Laravel\Sail\MeiliSearch;

    $scoutDriverParameter = P::SCOUT_DRIVER;
    $model = 'scoutDriver';
    $default = enum_option_selected($scoutDriverParameter, ScoutDriver::default())->value;

    $scout = new Scout();

    $customDriver = ScoutDriver::CUSTOM->value;

    $meiliSearch = new MeiliSearch();
    $meiliSearchDriver = ScoutDriver::MEILISEARCH->value;

    $algolia = new Algolia();
    $algoliaSearchDriver = ScoutDriver::ALGOLIA->value;

    $databaseSearchDriverId = "scout-driver-" . ScoutDriver::DATABASE->value;
    $databaseSearchDriver = ScoutDriver::DATABASE->value;

    $customSearchDriver = ScoutDriver::CUSTOM->value
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
            :model="$model"
            name="{{ $scoutDriverParameter }}"
            label="Custom"
            href="https://laravel.com/docs/scout#custom-engines"
        >
            You are installing or building your own driver implementation.
        </x-radio-option>

        <x-radio-option
            :id="$databaseSearchDriverId"
            :value="$databaseSearchDriver"
            :model="$model"
            name="{{ $scoutDriverParameter }}"
            label="Database"
            href="https://laravel.com/docs/scout#database-engine"
        >
            Use the full-text capabilities of your database.
        </x-radio-option>

        <x-radio-option
            :id="$meiliSearchDriver"
            :model="$model"
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
            :model="$model"
            name="{{ $scoutDriverParameter }}"
            label="{{ $algolia->name() }}"
            href="{{ $algolia->href() }}"
        >
            {{ $algolia->description() }}
        </x-radio-option>
    </x-form-control.group>
</x-form-section>