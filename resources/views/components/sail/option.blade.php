@php
    use InitializerForLaravel\Core\Contracts\Option;
@endphp
@props(['id', 'option'])
@php
    /** @var Option $option */

    $id = $option->id();
@endphp

<x-form-control.checkbox
    :id="$id"
    :heading="$option->name()"
    :href="$option->link()"
    {{ $attributes }}
>
    {!! $option->description() !!}

    <x-slot name="tags">
        <x-tags.sail/>
    </x-slot>
</x-form-control.checkbox>