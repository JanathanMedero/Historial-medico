<x-layouts::auth :title="__('Acceso al Sistema Médico')">
    <div class="flex flex-col gap-8 p-8 bg-white border border-zinc-200 shadow-xl rounded-2xl dark:bg-zinc-900 dark:border-zinc-800">

        <div class="flex flex-col items-center text-center">
            <div class="flex items-center justify-center w-20 h-20 mb-4 bg-blue-50 rounded-full dark:bg-blue-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-blue-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white mb-4">Control de Expedientes</h2>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="email"
                :label="__('Correo del Especialista')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="doctor@tuclinica.com"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Ingrese su clave')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-xs end-0 text-blue-600 hover:text-blue-700 font-medium" :href="route('password.request')" wire:navigate>
                        {{ __('¿Olvidó su contraseña?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Recordar credenciales')" :checked="old('remember')" class="text-zinc-600" />

            <div class="flex items-center justify-end pt-2">
                <flux:button variant="primary" type="submit" class="w-full !bg-blue-600 hover:!bg-blue-700 shadow-md h-12" data-test="login-button">
                    <span class="text-base font-bold">{{ __('Acceder al Panel Médico') }}</span>
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::auth>
