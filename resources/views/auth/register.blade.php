<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-floating-input name="name"
                    label="Name"
                    required />
            </div>

            <div class="mt-4">
                <x-floating-input name="email"
                    label="Email"
                    required />
            </div>

            <div class="mt-4">
                <x-floating-input name="password"
                    label="Password"
                    required />
            </div>

            <div class="mt-4">
                <x-floating-input name="password_confirmation"
                    label="Password_confirmation"
                    required />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label name="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-button class="m-auto">
                    {{ __('Register') }}
                </x-button>
            </div>

            <div class="mt-6 text-center text-gray-600">
                ya estas registrado
                <a class="underline text-sm text-indigo-500 hover:text-gray-900" href="{{ route('login') }}">
                    pulsa aqui
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>