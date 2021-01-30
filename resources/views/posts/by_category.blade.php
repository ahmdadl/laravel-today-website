<x-sidebar-layout>
    @include('posts.one', compact('posts'))

    @if($posts->count() > 15)
    <div class='pt-6 mt-5'>
        <hr class='mt-5 mb-2 border border-gray-500' />
        {{$posts->links()}}
    </div>
    @endif

    <x-slot name='sidebar'>
        <div class='mt-5'>
            @include('sidebar.search')
            @include('sidebar.popular', ['post' => $posts->first()])
            <div class='mt-10'>
                @include('sidebar.copy', [
                    'provider' => ($posts?->first() && !request()->is('category/*'))
                    ? $posts->first()?->provider
                    : null
                    ])
            </div>
            @include('sidebar.providers')
        </div>
    </x-slot>
</x-sidebar-layout>