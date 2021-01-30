<x-app-layout>
    <x-slot name='header'>
        @include('index.header')
    </x-slot>
    @include('posts.one', compact('posts'))
</x-app-layout>
