@php use InitializerForLaravel\Composer\ComposerDependency; @endphp
@props(['id', 'option'])
@php
    /** @var ComposerDependency $option */

    $id = $option->id();
@endphp

<x-form-control.checkbox
        :id="$id"
        :heading="$option->name()"
        :href="$option->href()"
        {{ $attributes }}
>
    {!! $option->description() !!}

    <x-slot name="tags">
        <x-tags.sail/>
    </x-slot>
</x-form-control.checkbox>