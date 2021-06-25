@php use App\Sail; @endphp

<x-form-section name="Local Development">
    <x-slot name="description">
        Configures <a class="font-medium text-red-600 hover:text-red-500" href="https://laravel.com/docs/sail">Laravel Sail</a>, which sets up a local development
        environment using <a class="font-medium text-red-600 hover:text-red-500" href="https://www.docker.com/">Docker</a> containers.
    </x-slot>

    <x-slot name="icon">
        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </x-slot>

    <div class="space-y-4 col-span-6">
        <x-sail.choice
            heading="Database"
            href="https://laravel.com/docs/database"
            :default="(new Sail\MySQLDatabase())->id()"
            :inline="true"
            :model="'sailDatabase'"
            :options="[
                new Sail\MySQLDatabase(),
                new Sail\MariaDatabase(),
                new Sail\PostgresDatabase(),
            ]"
        ></x-sail.choice>

        <x-sail.choice
            heading="Cache"
            href="https://laravel.com/docs/cache"
            :default="(new Sail\Redis())->id()"
            :inline="true"
            :model="'sailCache'"
            :options="[
                new Sail\Redis(),
                new Sail\Memcached(),
            ]"
        ></x-sail.choice>

        <x-sail.option :option="new Sail\MinIO()"></x-sail.option>
        <x-sail.option
            :option="new Sail\MeiliSearch()"
            :default="true"
        ></x-sail.option>
        <x-sail.option
            :option="new Sail\Mailhog()"
            :default="true"
        ></x-sail.option>
        <x-sail.option
            :option="new Sail\Selenium()"
            :default="true"
        ></x-sail.option>
    </div>
</x-form-section>
