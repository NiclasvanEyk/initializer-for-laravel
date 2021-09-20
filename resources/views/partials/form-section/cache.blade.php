@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\Sail;
    use \Domains\CreateProjectForm\Sections\Cache;

    $cacheParameter = P::CACHE_DRIVER;
    $model = \Str::studly($cacheParameter);
    $default = request(
        $cacheParameter,
        \Domains\CreateProjectForm\Sections\Cache\CacheOption::default(),
    );

    $redis = new Sail\Redis();
    $memcached = new Sail\Memcached();
    $dynamo = new Cache\DynamoDBCacheDBDriver();
@endphp

<x-form-section name="Cache">
    <x-slot name="description">
       {{-- Passage taken from the docs --}}
        <p class="mb-2">
            Some of the data retrieval or processing tasks performed by your
            application could be CPU intensive or take several seconds to
            complete.

            When this is the case, it is common to
            <x-link href="https://laravel.com/docs/cache">cache</x-link> the
            retrieved data for a time so it can be retrieved quickly on
            subsequent requests for the same data.
        </p>

        <p>
            The cache system is pretty flexible, so you can choose between a
            variety of drivers.
            <x-link href="https://laravel.com/docs/redis">Redis</x-link> is used
            by default when setting up a new Laravel application and can also be
            used for other things, such as powering your background queues.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.bolt />
    </x-slot>

    <x-form-control.group
        heading="Driver"
        href="https://laravel.com/docs/cache#configuration"
        x-data="{'{{ $model }}': '{{ $default }}'}"
    >
        <x-radio-option-none
            :model="$model"
            :name="$cacheParameter"
        />

        <x-radio-option
            :id="$redis->id() . '-cache'"
            :value="$redis->id()"
            :label="$redis->name()"
            :href="$redis->href()"
            :model="$model"
            :name="$cacheParameter"
        >
            {{ $redis->description() }}

            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-radio-option>

        <x-radio-option
            :id="$memcached->id()"
            :label="$memcached->name()"
            :href="$memcached->href()"
            :model="$model"
            :name="$cacheParameter"
        >
            {{ $memcached->description() }}

            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-radio-option>

        <x-radio-option
            :id="$dynamo->id()"
            :label="$dynamo->name()"
            :href="$dynamo->href()"
            :model="$model"
            :name="$cacheParameter"
        >
            {{ $dynamo->description() }}
        </x-radio-option>
    </x-form-control.group>
</x-form-section>