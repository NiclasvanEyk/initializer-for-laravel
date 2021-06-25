@props([
    'heading',
    'options',
    'model',
    'default' => 'none',
    'href' => null,
    'inline' => false,
])

@php
    /** @var \App\Sail\SailConfigurationOption[] $options */
@endphp

<x-option-group
    :heading="$heading"
    :href="$href"
    x-data="{'{{ $model }}': '{{ $default }}'}"
>
    @if($default === 'none')
    <x-radio-option-none :model="$model"></x-radio-option-none>
    @endif

    @foreach($options as $option)
        <x-radio-option
            :id="$option->id()"
            :model="$model"
            :inline="$inline"
            label="{{  $option->name() }}"
            href="{{ $option->href() }}"
        >
            {{ $option->description() }}
        </x-radio-option>
    @endforeach
</x-option-group>
