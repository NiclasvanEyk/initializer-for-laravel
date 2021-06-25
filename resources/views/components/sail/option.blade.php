@props(['option', 'default' => false])

<x-checkbox-option
    :id="$option->id()"
    :default="$default"
    label="{{ $option->name() }}"
    href="{{ $option->href() }}"
>
    {{ $option->description() }}
</x-checkbox-option>
