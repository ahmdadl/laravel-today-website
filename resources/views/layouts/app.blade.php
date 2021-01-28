<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="theme-dark">
        <div class="min-h-screen font-sans antialiased dark:text-gray-100 dark:bg-dark">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Content -->
            <main class="px-1 py-4 sm:px-2 md:py-3">
                {{ $slot }}
            </main>
        </div>
        <x-toast></x-toast>
    </body>
</html>
