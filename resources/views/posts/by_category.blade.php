<x-app-layout>
    @include('posts.one', compact('posts'))

    {{$posts->links()}}
</x-app-layout>