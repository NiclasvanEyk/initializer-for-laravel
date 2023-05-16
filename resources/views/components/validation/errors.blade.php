@props(['errors'])

@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp

@if ($errors->any())
    <div role="alert"
        class="
    p-4 rounded mb-10
    bg-primary-100 dark:bg-primary-800 dark:bg-opacity-50
    dark:text-gray-100
">
        <ul class="list-disc ml-4 space-y-2">
            @foreach ($errors->all() as $fieldErrors)
                <li>{{ $fieldErrors }}</li>
            @endforeach
        </ul>
    </div>
@endif
