@props(['heading', 'packages', 'href' => null])

@php
/** @var \Domains\Laravel\ComposerPackages\FirstPartyPackage[] $packages */
@endphp

<x-form-control.group heading="{{$heading}}" :href="$href">
    @foreach($packages as $package)
        <x-first-party-package.option :package="$package" flush />
    @endforeach
</x-form-control.group>
