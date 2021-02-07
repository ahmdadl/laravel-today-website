<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data
    :class="{'theme-dark': $store.common.dark}">

<head>
@include('layouts.head')
</head>

<body class="font-sans antialiased bg-gray-100 dark:text-gray-100 dark:bg-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="px-1 py-4 mt-16">
            <div class="flex flex-wrap">
                <div class='w-full px-1 lg:px-2 md:w-9/12'>
                    {{ $slot }}
                </div>
    
                <div class='w-full px-1 lg:px-2 md:w-3/12'>
                    {{ $sidebar }}
                </div>
            </div>
        </main>
        @include('footer')
    </div>
    <x-toast></x-toast>
</body>

</html>
