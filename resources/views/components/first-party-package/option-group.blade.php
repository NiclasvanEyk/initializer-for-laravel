@props(['heading', 'packages', 'href' => null])

@php
/** @var \App\Dependencies\Laravel\FirstPartyPackage[] $packages */
@endphp

<x-option-group
    heading="{{$heading}}"
    :href="$href"
>
    @foreach($packages as $package)
        <x-first-party-package.option
            :package="$package"
        ></x-first-party-package.option>
    @endforeach
</x-option-group>
