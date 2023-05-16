@props(['route'])

<a href="{{ route($route) }}"
    class="
    @if (Route::is($route)) dark:text-gray-100 select-none cursor-default
    @else
    text-primary-500 hover:underline @endif
">
    {{ $slot }}
</a>
