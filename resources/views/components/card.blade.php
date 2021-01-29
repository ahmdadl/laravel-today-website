@props([
    'icon' => null,
    'title',
    ])

    <div class="pb-2 text-center text-gray-700 bg-gray-200 rounded dark:bg-gray-800 dark:text-gray-300">
        @isset($icon)
            <div class="flex justify-center">
                <div class="flex items-center justify-center w-16 h-16 -mt-8 bg-gray-200 rounded-full dark:bg-gray-800">
                    <i class="text-4xl text-blue-500 {{ $icon }}">
                    </i>
                </div>
            </div>
        @endisset
        <div class="px-2 @isset($icon) mt-3  @endisset">
            <h1 class="text-xl font-bold text-blue-500 @unless(isset($icon)) 'bg-white dark:bg-gray-700' @endunless">
                {{ $title }}
            </h1>
            <p class="mt-2">
                {{ $slot }}
            </p>
        </div>
    </div>
