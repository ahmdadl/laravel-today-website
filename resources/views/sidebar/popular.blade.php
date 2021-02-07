<x-card title='Popular Posts'>
    <div x-data="{loading: true, posts: []}" x-init="$store.axios.get('/popular/{{ request()->is('/provider/*') ? $post?->provider_slug : $post?->category_slug }}').then(res => {
            if (res.status !== 200 || !res.data) return;
            loading = false;
            posts = res.data;
        }).finally(() => loading = false);">
        <template x-if='loading'>
            <div>
                <template x-for='i in [1, 2, 3, 4, 5]' :key='i'>
                    <svg role="img" aria-labelledby="loading-aria" viewBox="0 0 390 73" preserveAspectRatio="none">
                        <title id="loading-aria">Loading...</title>
                        <rect x="0" y="0" width="100%" height="100%" clip-path="url(#clip-path)"
                            style='fill: url("#fill");'></rect>
                        <defs>
                            <clipPath id="clip-path">
                                <rect x="7" y="1" rx="7" ry="7" width="111" height="68" />
                                <rect x="131" y="8" rx="0" ry="0" width="199" height="21" />
                                <rect x="346" y="8" rx="0" ry="0" width="43" height="21" />
                                <rect x="131" y="38" rx="0" ry="0" width="199" height="21" />
                            </clipPath>
                            <linearGradient id="fill">
                                <stop offset="0.599964" stop-color="#545454" stop-opacity="1">
                                    <animate attributeName="offset" values="-2; -2; 1" keyTimes="0; 0.25; 1" dur="2s"
                                        repeatCount="indefinite"></animate>
                                </stop>
                                <stop offset="1.59996" stop-color="#2b2b2b" stop-opacity="1">
                                    <animate attributeName="offset" values="-1; -1; 2" keyTimes="0; 0.25; 1" dur="2s"
                                        repeatCount="indefinite"></animate>
                                </stop>
                                <stop offset="2.59996" stop-color="#545454" stop-opacity="1">
                                    <animate attributeName="offset" values="0; 0; 3" keyTimes="0; 0.25; 1" dur="2s"
                                        repeatCount="indefinite"></animate>
                                </stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </template>
            </div>
        </template>
        <template x-if='!loading'>
            <template x-for='post in posts' :key='post.slug'>
                <a :href='post.url' target='_blank'
                    class='flex py-1 mt-3 transition duration-500 hover:bg-gray-300 dark:hover:bg-gray-700'>
                    <img class='object-cover w-1/4 h-full rounded' :src='post.image_url' :alt="post.slug + ' Avarar'" />
                    <div class='relative w-full'>
                        <div class='flex justify-between ml-1 space-x-1 font-semibold w3/4 md:ml-2'>
                            <span class='text-xs text-left' x-text='post.title'></span>
                            <span class='text-sm text-right text-gray-800 dark:text-gray-100'
                                x-text='$store.common.formatNum(post.likes_count)'></span>
                        </div>
                    </div>
                </a>
            </template>
        </template>
    </div>
</x-card>