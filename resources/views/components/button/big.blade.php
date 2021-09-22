@props(['secondary' => false])

<button
    {{ $attributes }}
    class="inline-flex flex-row items-center justify-center w-full px-3 py-2 text-xl font-bold transition border-4  rounded-md shadow-sm  sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500
    @if ($secondary)
    text-red-500 border-red-500 hover:bg-red-100 dark:hover:bg-red-900
    @else
    text-white bg-red-600 hover:bg-red-700 border-transparent
    @endif
    "
>
    {{ $slot }}
</button>