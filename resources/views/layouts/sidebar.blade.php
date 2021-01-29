<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data
    :class="{'theme-dark': $store.common.dark}">

<head>
@include('layouts.head')
</head>

<body class="font-sans antialiased bg-gray-100 dark:text-gray-100 dark:bg-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="container px-1 py-4 mt-16">
            <div class="row">
                <div class='col-12 sm:col-5'>
                    {{ $slot }}
                </div>
    
                <div class='col-12 sm:col-6'>
                    {{ $sidebar }}
                </div>
            </div>
        </main>
    </div>
    <x-toast></x-toast>
</body>

</html>
