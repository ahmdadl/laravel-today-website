<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data
    :class="{'theme-dark': $store.common.dark}">

<head>
@include('layouts.head')
</head>

<body class="font-sans antialiased bg-gray-100 dark:text-gray-100 dark:bg-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="px-1 py-4 mt-16 sm:px-2 lg:px-3">
            {{ $slot }}
        </main>
    </div>
    <x-toast></x-toast>
</body>

</html>
