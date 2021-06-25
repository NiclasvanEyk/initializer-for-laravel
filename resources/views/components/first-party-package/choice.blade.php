@props([
    'heading',
    'options',
    'model',
    'default' => 'none',
    'href' => null,
])

@php
    /** @var \App\Dependencies\Laravel\FirstPartyPackage[] $options */
@endphp

<x-option-group
    :heading="$heading"
    :href="$href"
    x-data="{'{{ $model }}': '{{ $default }}'}"
>
    @if($default === 'none')
    <x-radio-option-none :model="$model"></x-radio-option-none>
    @endif

    @foreach($options as $package)
        <x-radio-option
            :id="$package->id()"
            :model="$model"
            label="{{  $package->name() }}"
            href="{{ $package->href() }}"
        >
            {{ $package->description() }}
        </x-radio-option>
    @endforeach
</x-option-group>
