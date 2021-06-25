@props([
    'id',
    'label',
    'model',
    'isEmptyOption' => false,
    'inline' => false,
    'href' => null,
])

@php
$focusClasses = $isEmptyOption
    ? 'focus:ring-gray-400 text-gray-400'
    : 'focus:ring-red-500 text-red-600';
$backgroundClasses = $isEmptyOption
    ? 'bg-gray-100'
    : 'bg-red-100 bg-opacity-50';
$value = $isEmptyOption ? 'none' : $id;
@endphp

<label for="first-party-package-{{$id}}"
       class="flex items-start p-3"
       x-bind:class="{{$model}} === '{{$value}}' ? '{{ $backgroundClasses }} ' : ''"
>
    <div class="flex items-center h-5">
        <input type="radio" id="{{$id}}"
               name="{{ $model }}"
               value="{{ $value }}"
               x-model="{{ $model }}"
               aria-describedby="{{$id}}-label"
               class="h-4 w-4 border-gray-300 {{$focusClasses}}"
               {{ $attributes }}
        />
    </div>
    <div class="ml-3 text-sm select-none">
        <label id="{{$id}}-label" class="font-medium">
            <span x-bind:class="{{$isEmptyOption ? 'false' : 'true'}} && {{$model}} === '{{$id}}' ? 'text-gray-900 font-bold' : ''">
                @if($href !== null)
                    <a href="{{$href}}" class="hover:text-red-500 hover:underline" target="_blank">
                @endif
                    {{ $label }}
                @if($href !== null)</a>@endif
            </span>

            @unless($inline) <br/> @endunless

            <span x-bind:class="{{$isEmptyOption ? 'false' : 'true'}} && {{$model}} === '{{$id}}' ? 'text-gray-700' : 'text-gray-500'" >
                {{ $slot }}
            </span>
        </label>
    </div>
</label>
