<x-app-layout>
    <x-slot name='header'>
        @include('index.header')
    </x-slot>
    <h1 class='-mt-16 text-3xl font-bold text-center'>Latest News</h1>
    <hr class='mx-auto mt-1 mb-5 border border-current w-28' />
    @include('posts.one', [
        'posts' => $news,
        'provider' => null,
        'owner' => null,
    ])
    <h1 class='mt-8 text-3xl font-bold text-center'>Latest Tutorials</h1>
    <hr class='mx-auto mt-1 mb-5 border border-current w-28' />
    @include('posts.one', [
        'posts' => $tut,
        'provider' => null,
        'owner' => null,
    ])
</x-app-layout>
