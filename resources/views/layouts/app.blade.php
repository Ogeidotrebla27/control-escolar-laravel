<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control Escolar')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    
    <!-- NAVBAR -->
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">🎓 Sistema de Control Escolar</h1>
            <div class="flex gap-4">
                <a href="{{ route('alumnos.index') }}" class="hover:text-blue-200 transition">Alumnos</a>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="max-w-7xl mx-auto px-4 py-8 flex-1 w-full">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p class="text-sm">© {{ date('Y') }} Sistema de Control Escolar</p>
    </footer>

</body>
</html>
