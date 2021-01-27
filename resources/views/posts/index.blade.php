<x-app-layout>

    <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-0 sm:gap-x-2 md:gap-x-3'>
        @forelse($posts as $post)
            <article class='m-1 bg-gray-200 border border-gray-700 rounded dark:border-gray-300 dark:bg-gray-900'>
                <div class='overflow-hidden'>
                    <a href='{{ $post->url }}'>
                        <img class='object-cover transition-all duration-500 transform cursor-pointer hover:scale-125'
                            src='{{ $post->image_url }}' alt='{{ $post->title }}' />
                    </a>
                </div>
                <div class='p-2'>
                    <h5 class='pb-1 transition-colors border-b border-green-500 group'>
                        <a class='font-semibold text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-500'
                            href='{{ $post->url }}'>{{ $post->title }}</a>
                    </h5>
                    <div class='grid grid-cols-1 pt-3 md:grid-cols-2 gap-y-3'>
                        <a class='text-teal-600 author hover:text-teal-800 dark:text-teal-400 dark:hover:text-teal-500'
                            href='{{ $post->provider->owner->url }}'>
                            <img src='{{ $post->provider->owner->image_url }}'
                                alt='{{ $post->provider->owner->name }}'
                                class='inline-block object-cover rounded-full w-9 h-9' />
                            <span class='inline-block'>{{ $post->provider->owner->name }}</span>
                        </a>
                        <div class='text-gray-500 md:text-right dark:text-gray-400'>
                            <i class='fas fa-clock'></i>
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <hr class='my-2 border border-gray-400 dark:border-gray-700' />
                    <p class='text-gray-700 dark:text-gray-300'>
                        {{ $post->content }}
                    </p>
                </div>
            </article>
        @empty

        @endforelse
    </div>


    {{-- {{ $posts->links() }} --}}
</x-app-layout>
