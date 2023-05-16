@props(['id', 'value', 'name', 'checked' => false, 'colored', 'color'])

@php
    $color ??= 'red';
    $focusRing = match ($color) {
        'yellow' => 'focus:ring-yellow-500',
        'indigo' => 'focus:ring-indigo-500',
        default => 'focus:ring-primary-500',
    };
    
    $textColor = match ($color) {
        'yellow' => 'text-yellow-600',
        'indigo' => 'text-indigo-600',
        default => 'text-primary-600',
    };
@endphp

<label for="{{ $id }}" {{ $attributes->merge(['class' => 'flex flex-row items-center']) }}>
    <input id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
        class="h-3 w-3 mr-1 border-gray-300 round transition {{ $focusRing }}"
        x-bind:class="{!! $colored !!} ? '{{ $textColor }}' : 'text-gray-300 opacity-20'" type="radio"
        @if ($checked) checked @endif() />{{ $slot }}</label>
