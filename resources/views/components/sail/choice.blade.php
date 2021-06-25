@props([
    'heading',
    'options',
    'model',
    'default' => 'none',
    'href' => null,
    'inline' => false,
    'optional' => false,
])

@php
    /** @var \Domains\Laravel\Sail\SailConfigurationOption[] $options */
    /** @var string $model */

    // If we use a $model containing a "-", alpine will throw up if we use it
    // directly. So if it contains a dash, we'll change the alpine model to
    // CamelCase, but still use the original $model as the name, so the result
    // in the form won't be altered
    $name = substr($model, 0);
    $model = \Illuminate\Support\Str::contains($model, '-')
        ? \Illuminate\Support\Str::studly($model)
        : $model;
@endphp

<x-form-control.group
    :heading="$heading"
    :href="$href"
    x-data="{'{{ $model }}': '{{ $default }}'}"
>
    @if($default === 'none' || $optional)
        <x-radio-option-none :model="$model"></x-radio-option-none>
    @endif

    @foreach($options as $option)
        <x-radio-option
            :id="$option->id()"
            :model="$model"
            :name="$name"
            :inline="$inline"
            label="{{  $option->name() }}"
            href="{{ $option->href() }}"
        >
            {{ $option->description() }}
        </x-radio-option>
    @endforeach
</x-form-control.group>
