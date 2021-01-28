@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-green-400 text-white bg-blue-800 dark:bg-gray-800 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-blue-800 dark:hover:bg-gray-800 hover:border-white focus:outline-none focus:bg-blue-700 dark:focus:bg-gray-900 focus:border-whitetransition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
