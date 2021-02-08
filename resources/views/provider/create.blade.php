<x-app-layout>
    <x-slot name='header'>
        <header class='w-full h-48 pt-20 text-white bg-blue-700 shadow-md dark:bg-gray-900'>
            <h1 class='px-5 mt-3 text-3xl font-bold'>
                Submit New Provider
            </h1>
        </header>
    </x-slot>

    <x-card icon='fas fa-plus'>
        <form action="{{ route('post_provider') }}" method='post'
            class='grid w-full grid-cols-1 gap-3 px-3 pb-4 text-left md:grid-cols-2 md:gap-x-10' novalidate x-data="{
                name: '',
                email: '',
                avatar: '',
                profile: '',
                title: '',
                home_url: '',
                req_url: '',
                bio: ''
            }">
            @csrf
            <div>
                <div class='grid grid-cols-1 gap-3'>
                    <h2 class='text-2xl font-semibold'>User Details</h2>
                    <div>
                        <input type='text' name='name' x-model='name' class='w-full form-input' placeholder='User Name'
                            minlength='3' maxlength='100' required />
                        <x-input-error for='name'>
                            {{__('validation.between.string', [
                    'attribute' => 'User Name',
                    'min' => 3,
                    'max' => 100,
                ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <input type='email' name='email' x-model='email' class='w-full form-input'
                            placeholder='User Email Address' required />
                        <x-input-error for='email' rule='!$store.common.testMail(email)'>
                            {{__('validation.email', [
                        'attribute' => 'Email Address'
                    ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <input type='url' name='avatar' x-model='avatar' class='w-full form-input'
                            placeholder='User Avatar Url' />
                        <x-input-error for='avatar' rule='!$store.common.testUrl(avatar)'>
                            {{__('validation.url', [
                        'attribute' => 'Avatar URL Address'
                    ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <input type='url' name='profile' x-model='profile' class='w-full form-input'
                            placeholder='User Profile Url' />
                        <x-input-error for='profile' rule='!$store.common.testUrl(profile)'>
                            {{__('validation.url', [
                        'attribute' => 'Profile URL Address'
                    ])}}
                        </x-input-error>
                    </div>
                </div>
            </div>
            <div>
                <hr class='w-1/2 my-2 border-gray-300 md:hidden dark:border-gray-500' />
                <div class='grid grid-cols-1 gap-3'>
                    <h2 class='text-2xl font-semibold'>Provider Details</h2>
                    {{-- <p class='text-gray-400 dark:text-gray-600'></p> --}}
                    <div>
                        <input type='text' name='title' x-model='title' class='w-full form-input' placeholder='Title'
                            minlength='3' maxlength='50' required />
                        <x-input-error for='title'>
                            {{__('validation.between.string', [
                        'attribute' => 'Provider Title',
                        'min' => 5,
                        'max' => 50,
                    ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <input type='url' name='home_url' x-model='home_url' class='w-full form-input'
                            placeholder='Home Page URL' minlength='10' required />
                        <x-input-error for='home_url' rule='!$store.common.testUrl(home_url)'>
                            {{__('validation.url', [
                            'attribute' => 'Home Page URL Address'
                        ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <input type='url' name='req_url' x-model='req_url' class='w-full form-input'
                            placeholder='Request URL' minlength='10' required />
                        <x-input-error for='req_url' rule='!$store.common.testUrl(req_url)'>
                            {{__('validation.url', [
                            'attribute' => 'Request URL Address'
                        ])}}
                        </x-input-error>
                    </div>
                    <div>
                        <textarea name='bio' x-model='bio' class='w-full form-input' placeholder='Provider Biography'
                            maxlength='140' rows='5' cols='7'></textarea>
                        <x-input-error for='bio'>
                            {{__('validation.between.string', [
                            'attribute' => 'Provider Biography',
                            'min' => 15,
                            'max' => 140,
                        ])}}
                        </x-input-error>

                    </div>
                </div>
            </div>
            <div>
                <x-button type='submit' bg='green' icon='fas fa-save' class='w-1/3' x-bind:disabled="!name.length ||!email || !$store.common.testMail(email)|| !title || !$store.common.testUrl(home_url) ||!$store.common.testUrl(req_url)" :spin='1'>Save</x-button>
                <x-button clear='1' type='reset' bg='orange' icon='fas fa-times' class='w-1/3 mx-3 text-right'>reset
                </x-button>
            </div>
            </div>
        </form>
        </x-car>
</x-app-layout>
