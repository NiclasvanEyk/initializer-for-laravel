@props(['tooltip' => true])

@php
$classes = "bg-indigo-100 hover:bg-indigo-300
        dark:bg-indigo-800 dark:bg-opacity-70 dark:hover:bg-indigo-600
        text-indigo-800 dark:text-indigo-100
        transition";

if ($tooltip) {
    $classes .= "cursor-help";
}

$title = $tooltip
    ? "This option includes a Laravel Sail service, so you can develop locally using nearly the same infrastructure as in your production environment."
    : '';
@endphp

<x-tag
    class="{{ $classes }}"
    title="{{ $title }}"
>
    Sail
</x-tag>