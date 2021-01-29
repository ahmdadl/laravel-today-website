<x-card title='Providers'>
    <div x-data="{done: false, providers: [], getBg: () => {
        return ['bg-red-600', 'bg-green-600', 'bg-blue-600', 'bg-orange-600', 'bg-green-600', 'bg-teal-600', 'bg-purple-600'][Math.floor(Math.random() * 6)];
    }}" x-init="$store.axios.get('/providers').then(res => {
        if (!res.data) return;
        done = true;
        providers = res.data;
    }).finally(() => done = true)">
        <template x-if='!done'>
            <div class='flex flex-wrap'>
                <template x-for='i in Array(8).fill(Math.random())' :key='i'>
                    <div class='flex-grow-0 p-1 mx-1 my-2 bg-red-500 rounded animate-bounce'>Loading...</div>
                </template>
            </div>
        </template>
        <template x-if='done'>
            <div class='flex flex-wrap'>
                <template x-for='p in providers' :key='p.slug'>
                    <a :href="'/' + p.slug" :class="'mx-1 my-2 text-gray-300 rounded shadow-md hover:text-white ' + getBg()">
                        <span class='p-1' x-text='p.title'></span>
                        <span class='px-2 py-1 font-bold text-gray-800 bg-gray-100 dark:bg-gray-900 dark:text-gray-100' x-text='p.posts_count'></span>
                    </a>
                </template>
            </div>
        </template>
    </div>
</x-card>