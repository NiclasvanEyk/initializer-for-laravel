@php use InitializerForLaravel\Composer\ComposerDependency; @endphp
@props([
    'id',
    'package',
    'tags' => null,
])

@php /** @var ComposerDependency $package */ @endphp

<x-form-control.checkbox
        {{ $attributes->merge([ 'id' => $id ]) }}
        :heading="$package->name()"
        :href="$package->href()"
>
    {!! $package->description() !!}

    <x-slot name="tags">
        {{ $tags }}
    </x-slot>
</x-form-control.checkbox>