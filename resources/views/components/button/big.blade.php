@props(['secondary' => false])

<button {{ $attributes }}
    class="inline-flex flex-row items-center justify-center w-full px-3 py-2 text-xl font-bold transition border-4  rounded-md shadow-sm  sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500
    @if ($secondary) text-primary-500 border-primary-500 hover:bg-primary-100 dark:hover:bg-primary-900
    @else
    text-white bg-primary-600 hover:bg-primary-700 border-transparent @endif
    ">
    {{ $slot }}
</button>
