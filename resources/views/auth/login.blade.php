<x-guest-layout>
    <x-authentication-card>
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Iniciar Sesión
            </h2>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-floating-input name="email"
                        label="Email"
                        required />
                </div>

                <div>
                    <x-floating-input name="password"
                        label="Password"
                        required />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <x-checkbox name="remember" />
                        Recordarme
                    </label>

                    <a href="{{ route('password.request') }}"
                        class="text-indigo-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>

                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-200">
                    Ingresar
                </button>
                <div class="mt-6 text-center text-sm text-gray-600">
                    ¿no tienes cuenta?
                    <a href="{{ route('register') }}"
                        class="font-semibold text-indigo-600 hover:text-indigo-800 transition">
                        registrate aqui
                    </a>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>