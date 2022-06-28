<div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-0 sm:gap-x-2'>
    @foreach($posts as $post)
        <article class="max-w-2xl mx-auto overflow-hidden bg-gray-200 rounded-lg shadow-md dark:bg-gray-800" x-data="{
            slug: '{{ $post->slug }}',
            likes: {{ $post?->likes_count ?? 0 }},
            busy: false,
            isLiked: {{ $post->likes_count > 0 ? 1 : 0 }},
            btnTxt: '{{ $post->likes_count > 0 ? 'liked' : 'like' }}',
            old: '',
            addDislike: function () {
                if (!this.isLiked) return;
                this.old = this.btnTxt;
                this.btnTxt = 'dislike';
                var icon = this.$refs['icon{{ $post->slug }}'].classList;
                icon.remove('fa-thumbs-up');
                icon.add('fa-thumbs-down');
            },
            removeDisLike: function () {
                if (!this.old.length) return;
                var icon = this.$refs['icon{{ $post->slug }}'].classList;
                icon.remove('fa-thumbs-down');
                icon.add('fa-thumbs-up');

                return this.btnTxt = this.old;
            }}" id='{{ $post->slug }}'>
            <img class="object-cover w-full h-48 lazyload" data-src="{{ $post->image_url }}" alt="Avatar">

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
                            <img class="object-cover w-10 h-10 rounded-full lazyload" data-src="{{ $post?->author_img ?? 
                                $owner?->image_url ?? $post->provider->owner->image_url }}"
                                alt="{{ $owner?->name ?? $post->provider->owner->name }} Avatar">
                            <a href="{{ $post?->author_url ?? $owner?->url ?? $post->provider->owner->url }}"
                                target='_blank' class="mx-2 text-sm font-semibold text-gray-700 dark:text-gray-200">{{
                            $post?->author ?? $owner?->name ?? $post->provider->owner->name}}</a>
                        </div>
                        <span class="mx-1 text-xs text-right text-gray-700 dark:text-gray-300">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <hr class='my-2 border border-gray-400 dark:border-gray-700' />
                    <div class='flex flex-wrap text-center'>
                        <div class="w-1/2 text-xl text-left md:w-3/4">
                            <x-button bg='green' icon='fas fa-thumbs-up' clear='1' id='like'
                                x-bind:class="{'bg-green-500 liked': isLiked}" loader-id='{{ $post->slug }}'
                                x-on:mouseenter="addDislike()" x-on:mouseleave='removeDisLike()' x-on:click="$store.post.like(slug, 'fa-thumbs-up', 'like', !isLiked).then(r => {
                                    if (r) {
                                        likes = isLiked ? likes - 1 : likes + 1;
                                        isLiked = !isLiked;
                                        btnTxt = isLiked ? 'liked' : 'like';
                                        old = '';
                                    }
                                }).finally(() => {busy = false})">
                                <span class='md:text-xs' x-text='btnTxt'></span>
                            </x-button>
                        </div>
                        <div class='w-1/2 text-xl font-bold text-right text-gray-700 break-all md:w-1/4 dark:text-gray-500'
                            x-text='$store.common.formatNum(likes)'>
                        </div>
                        {{-- <span class="text-xl text-center">
                            <x-button bg='red' icon='fas fa-thumbs-down' clear='1' id='dislike'
                                x-on:click="busy = true;likes >= 0 ? $store.post.like(slug, 'fa-thumbs-down', 'dislike', false).then(r => {if (r && likes >= 1) likes -= 1}).finally(() => busy = false) : null"
                                x-bind:disabled='likes < 1'>
                            </x-button>
                        </span> --}}
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
