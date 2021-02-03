<x-sidebar-layout>
    @include('posts.one', [
        'posts' => $posts,
        'provider' => $provider ?? null,
        'owner' => $owner ?? null,
    ])

    @if($posts->count())
    <div class='pt-6 mt-5'>
        <hr class='mt-5 mb-2 border border-gray-500' />
        {{$posts->links()}}
    </div>
    @endif

    <x-slot name='sidebar'>
        <div class='mt-5'>
            <div class='mt-10'>
                @include('sidebar.search')
            </div>
            @include('sidebar.popular', ['post' => $posts->first()])
            <div class='mt-10'>
                @include('sidebar.copy', [
                    'provider' => $provider ?? null,
                    ])
            </div>
            @include('sidebar.providers')
        </div>
    </x-slot>
</x-sidebar-layout>