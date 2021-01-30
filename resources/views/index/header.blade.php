<div class="mt-16">
    <div class="pt-8 pb-6 mx-auto text-white bg-blue-800 dark:bg-gray-900 hero">
        <div class="grid items-center grid-cols-1 gap-8 hero-wrapper md:grid-cols-12">

            <div class="container col-span-6 px-4 mx-auto hero-text sm:px-8 lg:px-16 xl:px-20">
                <h1 class="max-w-xl text-4xl font-bold leading-tight text-gray-100 md:text-5xl">Find
                    Laravel latest News and Tutorials</h1>
                <hr class="h-1 mt-8 bg-red-500 border-0 rounded-full w-15">
                <p class="mt-8 text-base font-semibold leading-relaxed text-gray-400 capitalize dark:text-gray-500">
                    please note that all these posts belong to it`<small>s</small> own writers
                </p>
                <div class="flex justify-center mt-10 space-x-5 get-app md:justify-start" x-data="{q: ''}">
                    <form action='/' class='relative w-full search-form' method='get'>
                        <input type='search' name='q' x-model='q' autocapitalize='off' autocorrect="off"
                            class='w-full form-input focus:bg-blue-600' placeholder='Search for Posts or Providers'
                            style='text-indent: 2.5rem' />
                        <div class='absolute top-0 left-0 h-full'>
                            <div class='flex flex-wrap h-full'>
                                <x-button type='submit' bg='green' icon='fas fa-search' x-bind:disabled='q.length < 3'
                                    :rounded='0'>
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-span-6 mx-auto h-80 hero-image">
                <?xml version="1.0" encoding="UTF-8"?>
                <x-application-logo class='h-full text-red-500 fill-current dark:text-red-600 animate-bounce'></x-application-logo>
            </div>
        </div>
    </div>
</div>
