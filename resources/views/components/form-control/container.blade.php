@props([
    'input',
    'id',
    'heading',
    'activeCondition',
    'flush' => false,
    'href' => null,
])

<label {{ $attributes->merge([
    'class' => 'flex items-start p-3 w-full overflow-hidden transition group' . (
        $flush ? '' : ' rounded border'
    ),
    'for' => $id,
    'x-bind:class' => "$activeCondition
        ? 'bg-red-100 dark:bg-red-800 dark:bg-opacity-30 bg-opacity-50'
        : 'bg-white dark:bg-gray-900'",
]) }}>
    <div class="flex items-center h-5"> {{ $input }} </div>
    <div id="{{$id}}-label" class="ml-3 select-none w-full font-medium">
        <div
            class="flex flex-row items-center w-full font-semibold dark:text-gray-100 mb-1 sm:mb-0"
            x-bind:class="{{$activeCondition}} && 'text-gray-900 dark:text-gray-300'"
        >
            @if($href !== null)
            <a
                href="{{$href}}"
                class="hover:text-red-500 hover:underline" target="_blank"
            >
            @endif
                {{ $heading }}
            @if($href !== null)
            </a>
            @endif

            <div class="flex flex-1 flex-row items-center justify-end">
                {{ $tags }}
            </div>
        </div>

        <span x-bind:class="{{ $activeCondition }}
            ? 'dark:text-gray-400 text-gray-700'
            : 'text-gray-500'"
        >
            {{ $slot }}
        </span>
    </div>
</label>