<div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-0 sm:gap-x-2'>
    @foreach($posts as $post)
        <article class="max-w-2xl mx-auto overflow-hidden bg-gray-200 rounded-lg shadow-md dark:bg-gray-800"
            x-data="{slug: '{{ $post->slug }}', liked: {{ $post->liked }}}" id='{{ $post->slug }}'>
            <img class="object-cover w-full h-48" src="{{ $post->image_url }}" alt="Avatar">

            <div class="p-6">
                <div>
                    <a href='/{{ $provider?->slug ??$post->provider->slug }}'
                        class="px-2 py-1 text-xs font-medium text-white uppercase bg-red-600 rounded-full opacity-80 hover:opacity-100 hover:bg-red-800 hover:underline">{{ $provider?->title ?? $post->provider->title }}</a>
                    <a href="{{ $post->url }}" target='_blank'
                        class="block mt-2 text-xl font-semibold text-gray-800 dark:text-white hover:text-gray-600 hover:underline">{{ $post->title }}</a>
                </div>

                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <img class="object-cover w-10 h-10 rounded-full"
                                src="{{ $post?->author_img ?? 
                                $owner?->image_url ?? $post->provider->owner->image_url }}"
                                alt="{{ $owner?->name ?? $post->provider->owner->name }} Avatar">
                            <a href="{{ $post?->author_url ?? $owner?->url ?? $post->provider->owner->url }}" target='_blank'
                                class="mx-2 text-sm font-semibold text-gray-700 dark:text-gray-200">{{
                            $post?->author ?? $owner?->name ?? $post->provider->owner->name}}</a>
                        </div>
                        <span class="mx-1 text-xs text-gray-700 dark:text-gray-300">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <hr class='my-2 border border-gray-400 dark:border-gray-700' />
                    <div class='grid grid-cols-3 text-center'>
                        <span class="text-xl text-center">
                            <x-button bg='green' icon='fas fa-thumbs-up' clear='1' id='like'
                                x-on:click="$store.post.like(slug, 'fa-thumbs-up').then(r => {if (r) liked += 1})">
                            </x-button>
                        </span>
                        <span class='text-xl font-bold text-center text-gray-700 break-all dark:text-gray-500'
                            x-text='$store.common.formatNum(liked)'>
                        </span>
                        <span class="text-xl text-center">
                            <x-button class='disabled:cursor-not-allowed' bg='red' icon='fas fa-thumbs-down' clear='1'
                                id='dislike'
                                x-on:click="liked >= 0 ? $store.post.like(slug, 'fa-thumbs-down', false).then(r => {if (r && liked >= 1) liked -= 1}) : null"
                                x-bind:disabled='liked < 1'>
                            </x-button>
                        </span>
                    </div>
                </div>
            </div>
        </article>
    @endforeach
</div>

@if(!$posts->count())
    <div class='mx-auto text-center sm:w-3/4 md:w-1/2 alert alert-danger'>
        we could not found any posts
    </div>
@endif
