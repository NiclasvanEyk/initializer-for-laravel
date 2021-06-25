@props(['name', 'description', 'icon'])

@php
    $id = \Illuminate\Support\Str::slug($name);
@endphp

<section>
    <div class="mb-4">
        <h2
            class="text-xl font-bold leading-6 flex flex-row items-center
            text-gray-900 dark:text-gray-100"
            id="{{$id}}"
        >
            <a href="#{{$id}}">{{ $icon }}</a> {{ $name }}
        </h2>

        <section class="mt-1 text-gray-600 dark:text-gray-400">
            {{ $description }}
        </section>
    </div>

    <section class="space-y-4">
        {{$slot}}
    </section>
</section>
