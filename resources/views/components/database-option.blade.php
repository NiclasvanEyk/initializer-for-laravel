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
    class="
        flex-1 flex flex-col items-center justify-center
        rounded-md shadow overflow-hidden
        transition border
    "
    x-bind:class="database === '{{$id}}' ? 'dark:bg-opacity-30 dark:bg-indigo-900 bg-indigo-100 border-indigo-500 shadow-md' : 'bg-white dark:bg-black'"
>
    <header class="p-4 w-full flex flex-row dark:text-gray-100 justify-center items-center">
        <a href="{{$href}}" target="_blank">
            <img
                src="{{$logo->src}}" alt="{{$logo->alt}}"
                class="max-h-[48px] w-auto"
            />
        </a>

        <span class="ml-3 text-2xl">{{$heading}}</span>
    </header>

    <div class="flex-1 flex flex-col items-center my-4 w-full px-4">
        <p class="text-center dark:text-gray-100">
            {{$description}}
        </p>
    </div>

    <div
        class="p-4 w-full flex items-center justify-center transition"
        x-bind:class="database === '{{$id}}' ? 'dark:bg-opacity-0 bg-indigo-200' : 'bg-gray-100 dark:bg-gray-900'"
    >
        <input
            type="radio" id="{{$id}}" name="{{ $model }}" value="{{$id}}"
            x-model="{{ $model }}"
            class="focus:ring-indigo-500 text-indigo-600 transition"
        />
    </div>
</label>
