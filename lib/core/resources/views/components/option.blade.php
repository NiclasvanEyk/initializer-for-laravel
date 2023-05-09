@props(['id', 'heading', 'name' => null, 'href' => null, 'tags' => null, 'checked' => null, 'readonly' => false])

@php
    $name ??= $id;
    $checked ??= false;
@endphp

<x-initializer::custom-input-container activeCondition="checked"
    x-data="{ checked: {{ $checked ? 'true' : 'false' }} }"
    {{ $attributes }}>
    <x-slot name="input">
        <input type="checkbox"
            @if ($checked) checked @endif
            id="{{ $id }}"
            name="{{ $name }}"
            aria-describedby="{{ $id }}-label"
            class="mt-1 h-4 w-4 rounded border-gray-300 text-red-600 transition focus:ring-red-500"
            @if ($readonly) disabled @else value="{{ $id }}" x-on:change="checked = !checked" @endif />
    </x-slot>

    {{ $slot }}

    <x-slot name="tags">
        {{ $tags }}
    </x-slot>
</x-initializer::custom-input-container>