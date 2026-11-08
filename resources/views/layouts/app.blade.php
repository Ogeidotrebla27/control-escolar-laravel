<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Control Escolar') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- ENCABEZADO CON DATOS DE LA ESCUELA -->
            <header class="bg-slate-200 text-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        @php
    $config = App\Models\Configuracion::first();
    $logoPath = $config->logo ?? 'assets/img/logo.png';
@endphp
@if(file_exists(public_path($logoPath)))
    <img src="{{ asset($logoPath) }}" alt="Logo" class="h-20 w-auto">
@else
    <div class="h-16 w-16 bg-white bg-opacity-20 rounded-lg flex items-center justify-center text-2xl">🏫</div>
@endif
                        <div>
                            <h1 class="text-lg font-bold text-gray-800 uppercase tracking-wide">{{ App\Helpers\ConfiguracionHelper::nombre() }}</h1>
                            <p class="text-xs text-gray-800">
                                C.C.T.: {{ App\Helpers\ConfiguracionHelper::clave() }} | 
                                Z.E.: {{ App\Helpers\ConfiguracionHelper::zona() }} | 
                                S.E.: {{ App\Helpers\ConfiguracionHelper::sector() }}
                            </p>
                            <p class="text-xs text-gray-500">{{ App\Helpers\ConfiguracionHelper::direccion() }}</p>
                            <p class="text-xs text-gray-500 italic">"{{ App\Helpers\ConfiguracionHelper::lema() }}"</p>
                        </div>
                    </div>
                    <div class="text-right text-sm">
                        @auth
                            <p class="text-gray-500">Bienvenido(a)</p>
                            <p class="font-semibold text-gray-500">{{ Auth::user()->name }}</p>
                        @endauth
                    </div>
                </div>
            </header>
            <!-- HEADER (para los títulos de página) -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main>
                {{ $slot }}
            </main>

            <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-auto">
                <p class="text-sm">© {{ date('Y') }} {{ App\Helpers\ConfiguracionHelper::nombre() }} - Sistema de Control Escolar</p>
            </footer>
        </div>
    </body>
</html>