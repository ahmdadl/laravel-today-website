<x-sidebar-layout>
    @include('posts.one', compact('posts'))

    <div class='pt-6 mt-5'>
        <hr class='mt-5 mb-2 border border-gray-500' />
        {{$posts->links()}}
    </div>

    <x-slot name='sidebar'>
        <div class='mt-5'>
            @include('sidebar.search')
            @include('sidebar.popular', ['post' => $posts->first()])
            <div class='mt-10'>
                @include('sidebar.copy', [
                    'provider' => request()->is('provider/*')
                    ? $posts->first()?->provider
                    : null
                    ])
            </div>
        </div>
    </x-slot>
</x-sidebar-layout>