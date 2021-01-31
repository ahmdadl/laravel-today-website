<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('login') }}" x-data="{email: '', password: ''}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" placeholder="Email Address"
                    x-model='email' :value="old('email')" required autofocus />
                <x-input-error for='email' rule='!$store.common.testMail(email)'>
                    {{__('validation.email', [
                        'attribute' => 'Email Address',
                    ])}}
                </x-input-error>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1" type="password" name="password" x-model='password'
                    placeholder='Password' required autocomplete="current-password" />
                <x-input-error for='password' rule='password.length < 8'>
                    {{__('validation.gte.string', [
                        'attribute' => 'Password',
                        'value' => 8
                    ])}}
                </x-input-error>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if(Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button type='submit' bg='green' spin='1' icon='fas fa-sign-in-alt' class='ml-4'>
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
