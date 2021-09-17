@props(['route'])

<a href="{{ route($route) }}" class="
    @if(Route::is($route))
    dark:text-gray-100 select-none cursor-default
    @else
    text-red-500 hover:underline
    @endif
">
    {{ $slot }}
</a>
