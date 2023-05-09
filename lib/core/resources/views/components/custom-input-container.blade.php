@aware(['id', 'heading', 'href'])

@props(['input', 'activeCondition', 'flush' => false])

<label
    {{ $attributes->merge([
            'x-bind:class' => "$activeCondition
                    ? 'bg-red-100 dark:bg-red-800 dark:bg-opacity-30 bg-opacity-50'
                    : 'bg-white dark:bg-gray-900'",
            'for' => $id,
        ])->class(['flex items-start w-full overflow-hidden transition group', $flush ? null : ' rounded border']) }}>
    {{ $input }}
    <div id="{{ $id }}-label"
        class="ml-3 w-full select-none font-medium">
        <div class="mb-1 flex w-full flex-row items-center font-semibold dark:text-gray-100 sm:mb-0"
            x-bind:class="{{ $activeCondition }} && 'text-gray-900 dark:text-gray-300'">
            @if ($href !== null)
                <a href="{{ $href }}"
                    class="hover:text-red-500 hover:underline"
                    target="_blank">
            @endif
            {{ $heading }}
            @if ($href !== null)
                </a>
            @endif

            <div class="flex flex-1 flex-row items-center justify-end">
                {{ $tags }}
            </div>
        </div>

        <span
            x-bind:class="{{ $activeCondition }}
                ?
                'dark:text-gray-400 text-gray-700' :
                'text-gray-500'">
            {{ $slot }}
        </span>
    </div>
</label>