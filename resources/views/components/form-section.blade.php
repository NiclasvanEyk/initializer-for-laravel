@props(['name', 'description', 'icon'])

@php
    $id = \Illuminate\Support\Str::slug($name);
@endphp

<section>
    <div class="mb-4">
        <h2 class="flex flex-row items-center mb-2 text-2xl font-bold leading-6 text-gray-900 dark:text-gray-100"
            id="{{ $id }}">
            <a href="#{{ $id }}">{{ $icon }}</a> {{ $name }}
        </h2>

        <div class="mt-1 space-y-2 text-gray-600 dark:text-gray-400">
            {{ $description }}
        </div>
    </div>

    <div class="space-y-4">
        {{ $slot }}
    </div>
</section>
