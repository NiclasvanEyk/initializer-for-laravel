@props([
    'heading',
    'options',
    'model',
    'default' => 'none',
    'href' => null,
])

@php
    /** @var \Domains\Laravel\ComposerPackages\FirstPartyPackage[] $options */
@endphp

<x-form-control.group
    :heading="$heading"
    :href="$href"
    x-data="{'{{ $model }}': '{{ $default }}'}"
>
    @if($default === 'none')
        <x-radio-option-none :model="$model"></x-radio-option-none>
    @endif
    @foreach($options as $package)
        @php $packageId = $package->id(); @endphp
        <x-radio-option
            :id="$packageId"
            name="{{'packages[' . $model . ']='}}"
            :model="$model"
            label="{{  $package->name() }}"
            href="{{ $package->href() }}"
        >
            {{ $package->description() }}
        </x-radio-option>
    @endforeach
</x-form-control.group>
