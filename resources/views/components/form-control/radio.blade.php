@props([
    'id',
    'heading',
    'name' => null,
    'href' => null,
    'tags' => null,
    'checked' => false,
    'readonly' => false,
])

@php
    $name ??= $id;
@endphp

<x-form-control.container
    :id="$id"
    :heading="$heading"
    :href="$href"
    activeCondition="checked"
    x-data="{ checked: {{ $checked ? 'true' : 'false' }} }"
    {{ $attributes }}
>
    <x-slot name="input">
        <input type="checkbox" @if($checked) checked @endif
        id="{{ $id }}" name="{{ $name }}"
               aria-describedby="{{$id}}-label"
               class="mt-1 h-4 w-4 border-gray-300 rounded transition
                   focus:ring-red-500 text-red-600"
               @unless($readonly) value="{{ $id }}" @endif
               @if($readonly) disabled @endif
               @unless($readonly) x-on:change="checked = !checked" @endif
        />
    </x-slot>

    {{ $slot }}

    <x-slot name="tags">
        {{ $tags }}
    </x-slot>
</x-form-control.container>
