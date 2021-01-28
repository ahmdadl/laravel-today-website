<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data
    :class="{'theme-dark': $store.common.dark}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="preload" as='style'
        onload="this.onload=null; this.rel='stylesheet'">

    <script>
        function prefersDark() {
            return JSON.parse(localStorage.getItem('dark-theme')) || (!!window.matchMedia && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)
        }
        if (prefersDark()) {
            document.documentElement.classList.add('theme-dark')
        } else {
            document.documentElement.classList.remove('theme-dark')
        }

    </script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js" defer>
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-200 dark:text-gray-100 dark:bg-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="px-1 py-4 mt-16 sm:px-2 md:py-3">
            {{ $slot }}
        </main>
    </div>
    <x-toast></x-toast>
</body>

</html>
