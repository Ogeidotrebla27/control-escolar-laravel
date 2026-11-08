<x-guest-layout>
    <!-- ENCABEZADO INSTITUCIONAL -->
    <div class="text-center mb-6">
        @php
            $config = App\Models\Configuracion::first();
            $logoPath = $config->logo ?? 'assets/img/logo.png';
        @endphp
        
        @if(file_exists(public_path($logoPath)))
            <img src="{{ asset($logoPath) }}" alt="Logo" class="h-20 mx-auto mb-3">
        @endif
        
        <h1 class="text-xl font-bold text-gray-800 uppercase tracking-wide">
            {{ $config->nombre_escuela ?? 'Escuela Primaria' }}
        </h1>
        <p class="text-sm text-gray-500">
            C.C.T.: {{ $config->clave_centro_trabajo ?? '______' }} | Z.E.: {{ $config->zona_escolar ?? '___' }}
        </p>
        <p class="text-xs text-gray-400 mt-1">{{ $config->direccion ?? 'Dirección de la escuela' }}</p>
    </div>

    <!-- FORMULARIO DE LOGIN (Breeze) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-4">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>