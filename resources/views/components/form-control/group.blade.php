@props(['heading', 'href' => null])

<div
    class="rounded overflow-hidden border bg-white dark:bg-black group"
    {{ $attributes }}
>
    <span class="block p-3 text-sm text-gray-400 leading-tight dark:bg-gray-900 bg-gray-50 border-b">
        <span class="uppercase tracking-wide font-bold">
            {{ $heading }}
        </span>

        @if($href !== null)
            <a href="{{$href}}" target="_blank"
               class="opacity-0 group-hover:opacity-100 group-focus-within:opacity-100
                      inline-flex items-center float-right text-red-600 hover:underline focus:ring-red-700"
            >
                <svg class="h-[1em] w-[1em] inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                Documentation
            </a>
        @endif
    </span>

    <div class="divide-y">
        {{ $slot }}
    </div>
</div>
