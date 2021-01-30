<x-app-layout>
    <x-slot name='header'>
        <header class='w-full h-48 pt-20 text-white bg-blue-700 shadow-md dark:bg-gray-900'>
            <h1 class='px-5 mt-3 text-3xl font-bold'>
                Submit New Provider
            </h1>
        </header>
    </x-slot>

    <x-card icon='fas fa-plus'>
        <form action="{{route('post_provider')}}" method='post' class='grid w-full grid-cols-1 gap-3 px-3 pb-4 text-left' novalidate x-data>
            @csrf
            <h2 class='text-2xl font-semibold'>User Details</h2>
            <div>
                <div>
                    <input type='text' name='name' class='w-full form-input' placeholder='User Name' minlength='3' maxlength='100' required />
                   <input-error for='name'></input-error>
                </div>
            </div>
            <div>
                <input type='text' name='title' class='w-full form-input' placeholder='Title' minlength='3' maxlength='100' required />
               <input-error for='title'></input-error>
            </div>
            <div>
                <input type='url' name='home_url' class='w-full form-input' placeholder='Home Page URL' minlength='10' required />
               <input-error for='home_url'></input-error>
            </div>
            <div>
                <input type='url' name='req_url' class='w-full form-input' placeholder='Request URL' minlength='10' required />
               <input-error for='req_url'></input-error>
            </div>
        </form>
    </x-car>
</x-app-layout>