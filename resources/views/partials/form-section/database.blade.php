@php
    use Domains\Laravel\Sail\MariaDatabase;
    use Domains\Laravel\Sail\MySQLDatabase;
    use Domains\Laravel\Sail\PostgresDatabase;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $mysql = new MySQLDatabase();
    $mariaDb = new MariaDatabase();
    $postgres = new PostgresDatabase();

    $model = P::DATABASE;
    $default = old(P::DATABASE, request(
        P::DATABASE,
        Domains\CreateProjectForm\Sections\Database\DatabaseOption::default(),
    ));
@endphp

<x-form-section name="Database">
    <x-slot name="description">
        Choose one of the supported
        <x-link href="https://laravel.com/docs/database">databases</x-link>.
        In order to quickly spin up an in-memory database while running tests,
        <x-link href="https://www.sqlite.org">SQLite</x-link> is included by
        default.
    </x-slot>

    <x-slot name="icon">
        <x-icons.database />
    </x-slot>

    <fieldset
        role="radiogroup"
        class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4"
        x-data="{ {{ $model }}: '{{ $default }}' }"
    >
        <x-database-option :database="$mysql" :model="$model" />
        <x-database-option :database="$mariaDb" :model="$model" />
        <x-database-option :database="$postgres" :model="$model" />
    </fieldset>
</x-form-section>
