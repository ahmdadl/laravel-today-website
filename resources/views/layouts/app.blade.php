<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data
    :class="{'theme-dark': $store.common.dark}">

<head>
    @include('layouts.head')
</head>

<body class="font-sans antialiased bg-gray-100 dark:text-gray-100 dark:bg-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        {{ $header ?? '' }}

        <main class="px-1 py-4 mt-16 sm:px-2 lg:px-3">
            {{ $slot }}
        </main>
        @include('footer')
    </div>
    <x-toast></x-toast>

    <a target="_blank" class="fixed github-fork-ribbon right-top" href="https://github.com/abo3adel/project-todos"
        data-ribbon="Fork me on GitHub" title="Fork me on GitHub">Fork me on GitHub</a>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>
