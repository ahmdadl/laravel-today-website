<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('register') }}"
            x-data="{name: '{{ old('name') }}', email: '{{ old('email') }}', password: '{{ old('password') }}', password_confirmation: '{{ old('password_confirmation') }}'}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" x-model='name' required
                    autofocus />
                <x-input-error for='name'>

                </x-input-error>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" x-model='email' required />
                <x-input-error for='email' rule='!$store.common.testMail(email)'>
                    {{__('validation.email', [
                        'attribute' => 'Email Address',
                    ])}}
                </x-input-error>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1" type="password" name="password" x-model='password' required
                    autocomplete="new-password" />
                <x-input-error for='password' rule='password.length < 8'>
                    {{__('validation.gte.string', [
                                        'attribute' => 'Password',
                                        'value' => 8
                                    ])}}
                </x-input-error>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" x-model='password_confirmation' required />
                    <x-input-error for='password_confirmation' rule='password !== password_confirmation'>
                        {{__('validation.same', [
                            'attribute' => 'Password',
                            'other' => 'Confirm Password'
                        ])}}
                    </x-input-error>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button type='submit' bg='green' clear='1' icon='fas fa-sign-in-alt' spin='1' class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
