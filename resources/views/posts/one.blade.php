<div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-0 sm:gap-x-2 md:gap-x-3'>
    @forelse($posts as $post)
        <article class='relative m-1 bg-gray-200 border border-gray-700 rounded dark:border-gray-300 dark:bg-gray-900'
            x-data="{slug: '{{ $post->slug }}', liked: {{ $post->liked }}}" id='{{ $post->slug }}'>
            <a href="/{{ $post->provider->slug }}"
                class='absolute top-0 right-0 p-1 uppercase bg-red-600 rounded-tr opacity-80 hover:opacity-100 hover:bg-red-800 hover:underline'
                style='z-index: 2'>{{ $post->provider->title }}</a>
            <div class='overflow-hidden'>
                <a href='{{ $post->url }}' target='_blank'>
                    <img class='object-cover transition-all duration-500 transform cursor-pointer hover:scale-125'
                        src='{{ $post->image_url }}' alt='{{ $post->title }}' />
                </a>
            </div>
            <div class='p-2'>
                <h5 class='pb-1 transition-colors border-b border-green-500 group'>
                    <a class='font-semibold text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-500'
                        href='{{ $post->url }}' target='_blank'>{{ $post->title }}</a>
                </h5>
                <div class='grid grid-cols-1 pt-3 md:grid-cols-2 gap-y-3'>
                    <a class='text-teal-600 author hover:text-teal-800 dark:text-teal-400 dark:hover:text-teal-500'
                        target='_blank' href='{{ $post->provider->owner->url }}'>
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
                <div class='grid grid-cols-3 text-center'>
                    <span class="text-xl text-center">
                        <x-button bg='green' icon='fas fa-thumbs-up' clear='1' id='like'
                            x-on:click="$store.post.like(slug, 'fa-thumbs-up').then(r => {if (r) liked += 1})">
                        </x-button>
                    </span>
                    <span class='text-xl text-center text-gray-700 break-all dark:text-gray-500'
                        x-text='$store.common.formatNum(liked)'>
                    </span>
                    <span class="text-xl text-center">
                        <x-button bg='red' icon='fas fa-thumbs-down' clear='1' id='dislike'
                            x-on:click="liked >= 0 ? $store.post.like(slug, 'fa-thumbs-down', false).then(r => {if (r && liked >= 1) liked -= 1}) : null"
                            x-bind:disabled='liked < 1'>
                        </x-button>
                    </span>
                </div>
            </div>
        </article>
    @empty
        <div class='alert alert-danger'>
            we could not found any posts in this category
        </div>
    @endforelse
</div>