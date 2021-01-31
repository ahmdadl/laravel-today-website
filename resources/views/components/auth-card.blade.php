<div class="flex flex-col items-center min-h-screen pt-6 bg-transparent sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-gray-200 shadow-md dark:bg-gray-800 dark:text-white sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
