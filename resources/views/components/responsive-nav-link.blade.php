@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-white bg-blue-800 dark:bg-gray-800 focus:outline-none'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-blue-800 dark:hover:bg-gray-800 hover:border-white focus:outline-none focus:bg-blue-700 dark:focus:bg-gray-900 focus:border-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
