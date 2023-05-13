@props(['id', 'label', 'model', 'name' => null, 'isEmptyOption' => false, 'inline' => false, 'href' => null, 'none' => false, 'tags' => null, 'value' => null])

@php
    $focusClasses = $isEmptyOption ? 'focus:ring-gray-400 text-gray-400' : 'focus:ring-red-500 text-red-600';
    $backgroundClasses = $isEmptyOption ? 'bg-gray-100 dark:bg-gray-900' : 'dark:bg-red-800 dark:bg-opacity-30 bg-red-100 bg-opacity-50';
    $value = $isEmptyOption ? 'none' : $value;
    $value ??= $id;
@endphp

<label for="{{ $id }}" id="{{ $id }}-option"
    class="flex items-start p-3 transition wiggles-when-targeted"
    x-bind:class="{{ $model }} === '{{ $value }}' ? '{{ $backgroundClasses }} ' : 'dark:bg-gray-900'">
    <div class="flex items-center h-5">
        <input type="radio" id="{{ $id }}" name="{{ $name ?? $model }}" value="{{ $value }}"
            x-model="{{ $model }}" aria-describedby="{{ $id }}-label"
            class="mt-1 h-4 w-4 border-gray-300 {{ $focusClasses }} transition" {{ $attributes }} />
    </div>
    <div class="w-full ml-3 select-none">
        <span id="{{ $id }}-label" class="font-medium">
            <div @if ($isEmptyOption) class="text-gray-500" @endif
                class="flex flex-row items-center w-full font-semibold dark:text-gray-100">
                @if ($href !== null)
                    <a href="{{ $href }}" class="hover:text-red-500 hover:underline" target="_blank">
                @endif
                {{ $label }}
                @if ($href !== null)
                    </a>
                @endif

                <div class="flex flex-row items-center justify-end flex-1 gap-x-2">
                    {{ $tags }}
                </div>
            </div>

            <span
                x-bind:class="{{ $isEmptyOption ? 'false' : 'true' }} && {{ $model }} === '{{ $value }}' ?
                    'text-gray-700 dark:text-gray-400' : 'text-gray-500'">
                {{ $slot }}
            </span>
        </span>
    </div>
</label>
