<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="{{ url('/img/og/initializer-for-laravel.png') }}" />

    <title>{{ config('app.name') }}</title>

    {{-- https://css-tricks.com/emojis-as-favicons --}}
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🚀</text></svg>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            scroll-margin-top: 50px;
        }
    </style>
</head>
<body class="antialiased dark:bg-gray-900">
<div class="relative flex flex-col justify-center min-h-screen py-4 bg-white subtle-background-pattern items-top sm:pt-0 dark:bg-gray-900 dark:text-gray-100"
>
    <div class="flex flex-col flex-1 w-full max-w-6xl px-4 mx-auto">
        <x-layout.header />

        {{ $slot }}
    </div>
</div>
</body>
</html>
