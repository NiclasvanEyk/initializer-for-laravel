<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="LtXTpnxyz3li3YHOVCUUgIM_pGUf9Da8QEk48LVqeck" />

    <x-head.opengraph-tags :url="url('/')" :title="config('app.name')" :description="'A quickstart generator for Laravel projects.'" :image="url('/img/og/initializer-for-laravel.png')" />

    <title>{{ config('app.name') }}</title>

    {{-- https://css-tricks.com/emojis-as-favicons --}}
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🚀</text></svg>">

    <!-- Fonts -->
    @googlefonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            scroll-margin-top: 50px;
        }
    </style>
</head>

<body class="antialiased dark:bg-gray-900" x-data="theme">
    <div class="relative flex flex-col justify-center min-h-screen py-4 bg-white subtle-background-pattern items-top sm:pt-0 dark:bg-gray-900 dark:text-gray-100"
        x-bind="themeProvider">
        <div class="flex flex-col flex-1 w-full max-w-6xl px-4 mx-auto" {{ $attributes }}>
            <x-layout.header />

            {{ $slot }}
        </div>
    </div>
</body>

</html>