<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class='flex flex-wrap space-3'>
            <div class='w-1/3'>
                {!!Encore\Admin\Controllers\Dashboard::environment()!!}
            </div>
            <div class='w-1/3'>
                {!!Encore\Admin\Controllers\Dashboard::extensions()!!}
            </div>
            <div class='w-1/3'>
                {!!Encore\Admin\Controllers\Dashboard::dependencies()!!}
            </div>
        </div>
    </div>
</x-app-layout>
