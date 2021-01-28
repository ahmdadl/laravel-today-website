<nav x-data="{ open: false }"
    class="fixed top-0 left-0 z-10 w-full bg-blue-900 border-b border-green-300 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto capitalize max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block w-auto h-10 text-gray-600 fill-current" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>
                    <x-nav-link href="/category/news" :active='request()->is("category/news")'>
                        News
                    </x-nav-link>
                    <x-nav-link href="/category/tutorial" :active="request()->is('category/tutorial')">
                        Tutorial
                    </x-nav-link>
                </div>
            </div>


            <x-theme-toggler></x-theme-toggler>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-nav-link href="https://abo3adel.github.io/" target='_blank'>
                    <img class='inline-block object-cover w-10 h-10 mx-1 rounded-full' src='https://images.test/users/2.jpg'
                        alt='Ahmed Adel Profile Image' />
                    <span class='inline-block'>Ahmed Adel</span>
                </x-nav-link>
            </div>

            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-300 transition duration-150 ease-in-out rounded-md hover:text-gray-100 hover:bg-blue-800 dark:hover:bg-gray-800 dark:focus:bg-gray-800 focus:outline-none focus:bg-blue-800 focus:text-gray-100" :class='{"bg-blue-800 dark:bg-gray-700": open}'>
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/category/news" :active="request()->is('category/news')">
                News
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/category/tutorial" :active="request()->is('category/tutorial')">
                Tutorial
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
