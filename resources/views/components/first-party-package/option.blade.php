@props(['package'])

<x-checkbox-option
    :id="$package->id()"
    label="{{ $package->name() }}"
    href="{{ $package->href() }}"
>
    {{ $package->description() }}
</x-checkbox-option>
