<nav x-data="{ open: false }" class="fixed top-0 left-0 z-10 w-full text-gray-200 bg-blue-900 dark:bg-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto capitalize max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}">
                        <x-application-logo w='25' h='25' class="block w-auto h-10 text-gray-600 fill-current" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/category/news" :active='request()->is("category/news")'>
                        <i class="px-1 fas fa-newspaper"></i>
                        News
                    </x-nav-link>
                    <x-nav-link href="/category/tutorial" :active="request()->is('category/tutorial')">
                        <i class="px-1 fas fa-mortar-board"></i>
                        Tutorial
                    </x-nav-link>
                    <x-nav-link :href="route('add_provider')" :active="request()->routeIs('add_provider')"
                        class='hidden font-bold md:flex'>
                        <i class="px-1 fas fa-plus"></i>
                        Submit a Provider
                    </x-nav-link>
                </div>
            </div>

            <x-theme-toggler></x-theme-toggler>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @can('browse_admin')
                    <x-nav-link href="/admin">
                        <img class='inline-block object-cover w-10 h-10 mx-1 rounded-full lazyload'
                            data-src='https://abo3adel.github.io/myImg.jpeg' alt='Ahmed Adel Profile Image' />
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-nav-link class='bg-red-600 rounded' href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">

                            {{ __('Logout') }}
                        </x-nav-link>
                    </form>
                @else
                    <x-nav-link href="https://abo3adel.github.io/" target='_blank'>
                        <img class='inline-block object-cover w-10 h-10 mx-1 rounded-full lazyload'
                            data-src='https://abo3adel.github.io/myImg.jpeg' alt='Ahmed Adel Profile Image' />
                        <span class='inline-block'>Ahmed Adel</span>
                    </x-nav-link>
                @endcan
            </div>

            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center text-gray-300 transition duration-500 ease-in-out border-4 border-transparent rounded-full w-13 h-13 hover:border-gray-200 focus:outline-none"
                    :class='{"border-gray-200": open}'>
                    <img class='inline-block object-cover w-full h-full mx-1 rounded-full lazyload'
                        data-src='https://abo3adel.github.io/myImg.jpeg' alt='Ahmed Adel Profile Image' />
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/category/news" :active="request()->is('category/news')">
                <i class='px-1 fas fa-newspaper'></i>
                News
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/category/tutorial" :active="request()->is('category/tutorial')">
                <i class="px-1 fas fa-mortar-board"></i>
                Tutorial
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('add_provider')" :active="request()->routeIs('add_provider')">
                <i class="px-1 fas fa-plus"></i>
                Submit a Provider
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
