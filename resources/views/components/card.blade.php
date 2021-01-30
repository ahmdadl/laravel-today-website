@props([
    'icon',
    'title' => '',
    'p' => 'px-1',
    'dir' => 'text-center',
    ])

    <div class="my-3 {{$dir}} text-gray-700 bg-gray-200 rounded dark:bg-gray-800 dark:text-gray-300" {{$attributes}}>
        @isset($icon)
            <div class="flex justify-center">
                <div class="flex items-center justify-center w-16 h-16 -mt-8 bg-gray-200 rounded-full dark:bg-gray-800">
                    <i class="text-4xl text-blue-500 {{ $icon }}">
                    </i>
                </div>
            </div>
        @endisset
        <div class="@isset($icon) mt-3 @endisset">
            <h1 class="text-xl font-bold @unless (isset($icon))
                py-1 px-2 bg-blue-500 dark:bg-blue-800 text-white rounded-tl rounded-tr @else text-blue-500
@endunless">
                {{ $title }}
            </h1>
            <div class="{{$p}} mt-2 ">
                {{ $slot }}
        </div>
    </div>
    </div>
