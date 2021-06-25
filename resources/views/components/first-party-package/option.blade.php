@props([
    'id',
    'package',
    'tags' => null,
])

@php /** @var \Domains\Composer\ComposerDependency $package */ @endphp

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
