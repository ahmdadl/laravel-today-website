<x-app-layout>
    <div class='min-h-screen'>
        <x-card title='Check for Provider Status' dir='text-left'
            x-data="{title: '', req_url: '', errors: {title: '', req_url: ''}, loading: false, status: '', found: false}">
            <div x-show='null === found' x-cloak>
                <div class='alert alert-danger'>
                    No provider was found with these credentials
                </div>
            </div>
            <form action='' method='post' x-show="!found" class='grid grid-cols-1 gap-4 p-4' novalidate
                x-on:submit.prevent="loading = true;$store.axios.post('/providers/check', {title, req_url}).then(res => {
                if (res.status === 422) {
                    errors = res.data.errors;
                    return;
                }

                if (res.status === 204) found = null;

                if (res.status !== 200 || !res.data) return;
                found = true;
                status = res.data.status;
            }).finally(() => loading = false)">
                @csrf
                <div>
                    <input type='text' name='title' x-model='title' class='w-full form-input' placeholder='Title'
                        minlength='3' maxlength='50' required />
                    <x-input-error for='title' rule='1 || errors.title.length'>
                        {{__('validation.between.string', [
                    'attribute' => 'Provider Title',
                    'min' => 5,
                    'max' => 50,
                ])}}
                    </x-input-error>
                </div>
                <div>
                    <input type='url' name='req_url' x-model='req_url' class='w-full form-input'
                        placeholder='Request URL Address' minlength='10' required />
                    <x-input-error for='req_url' rule='!$store.common.testUrl(req_url) && 1 || errors.req_url.length'>
                        {{__('validation.url', [
                        'attribute' => 'Request URL Address'
                    ])}}
                    </x-input-error>
                </div>
                <div>
                    <x-button type='submit' bg='green' icon='fas fa-search'
                        x-bind:disabled="!title || !req_url || !$store.common.testUrl(req_url)">
                        <i class='px-1 fas' :class="{'fa-spin fa-cog': loading}"></i>
                        Check
                    </x-button>
                </div>
            </form>
            <div class='p-4' x-show='found' x-cloak :class="{
                'text-green-800 bg-green-500 dark:bg-green-300': status === 'approved',
                'text-red-800 bg-red-500 dark:bg-red-300': status === 'rejected',
                'text-orange-800 bg-orange-500 dark:bg-orange-300': status === 'pending',
            }">
                <h3 class='text-3xl font-semibold'>
                    Status: <span class='text-white' x-text='status'></span>
                </h3>
            </div>
        </x-card>
    </div>
</x-app-layout>
