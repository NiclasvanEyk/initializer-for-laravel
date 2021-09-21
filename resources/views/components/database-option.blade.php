@props(['database', 'model'])

@php
/** @var \Domains\Laravel\Sail\DatabaseOption $database */
/** @var string $model */

$id = $database->id();
$href = $database->href();
$heading = $database->name();
$description = $database->description();
$logo = $database->logo();

@endphp

<label
    for="{{$id}}"
    class="flex flex-col items-center justify-center flex-1 overflow-hidden transition border rounded-md shadow "
    x-bind:class="database === '{{$id}}' ? 'dark:bg-opacity-30 dark:bg-indigo-900 bg-indigo-100 border-indigo-500 shadow-md' : 'bg-white dark:bg-gray-900'"
>
    <header class="flex flex-row items-center justify-center w-full p-4 dark:text-gray-100">
        <a href="{{$href}}" target="_blank">
            <img
                src="{{$logo->src}}" alt="{{$logo->alt}}"
                class="max-h-[48px] w-auto"
            />
        </a>

        <span class="ml-3 text-2xl">{{$heading}}</span>
    </header>

    <div class="flex flex-col items-center flex-1 w-full px-4 my-4">
        <p class="text-center dark:text-gray-100">
            {{$description}}
        </p>
    </div>

    <div
        class="flex items-center justify-center w-full p-4 transition"
        x-bind:class="database === '{{$id}}' ? 'dark:bg-opacity-0 bg-indigo-200' : 'bg-gray-100 dark:bg-gray-800'"
    >
        <input
            type="radio" id="{{$id}}" name="{{ $model }}" value="{{$id}}"
            x-model="{{ $model }}"
            class="text-indigo-600 transition focus:ring-indigo-500"
        />
    </div>
</label>
