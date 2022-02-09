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

    $dbalParameter = P::USES_DBAL;
    $usesDbal = checkbox_checked($dbalParameter);
    $dbal = new \Domains\Laravel\RelatedPackages\Database\DoctrineDbal()
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
        class="flex flex-col justify-between space-y-4 md:flex-row md:space-y-0 md:space-x-4"
        x-data="{ {{ $model }}: '{{ $default }}' }"
    >
        <x-database-option :database="$mysql" :model="$model" />
        <x-database-option :database="$mariaDb" :model="$model" />
        <x-database-option :database="$postgres" :model="$model" />
    </fieldset>

    <p class="text-gray-600 dark:text-gray-400">
        For some actions involving migrations it is required to install the
        <code>doctrine/dbal</code> package. If you plan to e.g.
        <x-link href="https://laravel.com/docs/migrations#modifying-columns">modify existing columns</x-link>
        to make them nullable, make sure to include this package!
    </p>

    <x-form-control.checkbox
        :id="$dbalParameter"
        :heading="$dbal->name()"
        :href="$dbal->href()"
        :checked="$usesDbal"
    >
        {{ $dbal->description() }}
    </x-form-control.checkbox>
</x-form-section>