@props(['name', 'description', 'icon'])

@php
    $id = \Illuminate\Support\Str::slug($name)
@endphp

<section>
    <div class="mb-4">
        <h2
            class="text-2xl tracking-tight font-semibold leading-6 flex flex-row items-center
            text-gray-900 dark:text-gray-100 mb-2"
            id="{{$id}}"
        >
            <a href="#{{$id}}">{{ $icon }}</a> {{ $name }}
        </h2>

        <div class="mt-1 text-gray-600 dark:text-gray-400 space-y-2">
            {{ $description }}
        </div>
    </div>

    <div class="space-y-4">
        {{$slot}}
    </div>
</section>