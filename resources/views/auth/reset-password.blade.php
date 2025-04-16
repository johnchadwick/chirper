<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password (with Toggle) -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <button
                    type="button"
                    onclick="togglePassword('password', 'togglePasswordLabel')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-gray-600 hover:text-gray-900 focus:outline-none"
                    aria-label="Toggle password visibility"
                    id="togglePasswordButton"
                >
                    <span id="togglePasswordLabel">Show</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password (with Toggle) -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <button
                    type="button"
                    onclick="togglePassword('password_confirmation', 'togglePasswordConfirmationLabel')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-gray-600 hover:text-gray-900 focus:outline-none"
                    aria-label="Toggle password visibility"
                    id="togglePasswordConfirmationButton"
                >
                    <span id="togglePasswordConfirmationLabel">Show</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePassword(fieldId, labelId) {
            const passwordField = document.getElementById(fieldId);
            const toggleLabel = document.getElementById(labelId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleLabel.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleLabel.textContent = "Show";
            }
        }
    </script>
</x-guest-layout>
