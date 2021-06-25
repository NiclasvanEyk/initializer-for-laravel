@props([
    'id',
    'label',
    'type' => 'checkbox',
    'name' => null,
    'inline' => false,
    'href' => null,
    'default' => false,
])

<label for="first-party-package-{{$id}}"
       class="flex items-start p-3"
       x-bind:class="checked ? 'bg-red-100 bg-opacity-25' : ''"
       x-data="{ checked: @if($default) true @else false @endif }"
>
    <div class="flex items-center h-5">
        <input type="{{ $type }}" @if($default) checked @endif
               id="first-party-package-{{$id}}"
               name="@if($name !== null) {{ $name }} @else first-party-package-{{$id}} @endif"
               aria-describedby="first-party-package-{{$id}}-label"
               x-on:change="checked = !checked"
               class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded"
               {{ $attributes }}
        />
    </div>
    <div class="ml-3 text-sm select-none">
        <label id="first-party-package-{{$id}}-label" class="font-medium">
            <span x-bind:class="checked ? 'text-gray-900 font-bold' : ''">
                @if($href !== null)
                    <a href="{{$href}}" class="hover:text-red-500 hover:underline" target="_blank">
                @endif
                        {{ $label }}
                        @if($href !== null)</a>@endif
            </span>

            @unless($inline) <br/> @endunless

            <span x-bind:class="checked ? 'text-gray-700' : 'text-gray-500'" >
                {{ $slot }}
            </span>
        </label>
    </div>
</label>
