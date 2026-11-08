<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Listados de Alumnos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- SELECTOR DE GRUPO -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 no-print">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Seleccionar Grupo</h3>
                <form method="GET" action="{{ route('listados.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Grado</label>
                        <select name="grado" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Seleccionar</option>
                            @foreach($grupos->unique('grado') as $grupo)
                                <option value="{{ $grupo->grado }}" {{ request('grado') == $grupo->grado ? 'selected' : '' }}>
                                    {{ $grupo->grado }}°
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Grupo</label>
                        <select name="grupo" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Seleccionar</option>
                            @foreach($grupos->unique('grupo') as $grupo)
                                <option value="{{ $grupo->grupo }}" {{ request('grupo') == $grupo->grupo ? 'selected' : '' }}>
                                    {{ $grupo->grupo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold">
                            Ver Listado
                        </button>
                    </div>
                </form>
            </div>

            @if($alumnos->count() > 0)
                <!-- BOTONES DE EXPORTACIÓN -->
                <div class="flex gap-3 mb-4 no-print">
    <a href="{{ route('listados.print', ['grado' => $gradoSeleccionado, 'grupo' => $grupoSeleccionado]) }}" 
   target="_blank"
   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold">
    🖨️ Ver e Imprimir Listado
</a>
    <a href="{{ route('listados.pdf', ['grado' => $gradoSeleccionado, 'grupo' => $grupoSeleccionado]) }}" 
       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold">
        📄 Exportar a PDF
    </a>
    <a href="{{ route('listados.excel', ['grado' => $gradoSeleccionado, 'grupo' => $grupoSeleccionado]) }}" 
       class="bg-red-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
        📊 Exportar a Excel
    </a>
</div>

                <!-- VISTA PREVIA DEL LISTADO -->
                <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
                    <div class="text-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $config->nombre_escuela ?? 'Escuela Primaria' }}</h3>
                        <p class="text-sm text-gray-600">C.C.T.: {{ $config->clave_centro_trabajo ?? '______' }} | Z.E.: {{ $config->zona_escolar ?? '___' }} | S.E.: {{ $config->sector_educativo ?? '___' }}</p>
                        <p class="text-sm text-gray-600">{{ $config->direccion ?? 'Dirección de la escuela' }}</p>
                        <h4 class="text-md font-bold text-blue-800 mt-2">Lista de Alumnos - {{ $gradoSeleccionado }}° "{{ $grupoSeleccionado }}"</h4>
                        <p class="text-sm text-gray-600">Fecha: {{ date('d/m/Y') }}</p>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-2 py-1 text-center">No.</th>
                                <th class="border border-gray-300 px-2 py-1 text-left">Nombre del Alumno</th>
                                @for($i = 1; $i <= 20; $i++)
                                    <th class="border border-gray-300 px-1 py-1 text-center w-8">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos as $index => $alumno)
                            <tr>
                                <td class="border border-gray-300 px-2 py-1 text-center">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-2 py-1">{{ $alumno->apellidos }} {{ $alumno->nombre }}</td>
                                @for($i = 1; $i <= 20; $i++)
                                    <td class="border border-gray-300 px-1 py-1 text-center"></td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 text-sm">
                        <p><strong>Total de alumnos:</strong> {{ $alumnos->count() }}</p>
                    </div>

                    <div class="mt-8 flex justify-between text-sm">
                        <div class="text-center">
                            <div class="border-t border-gray-400 w-48 mx-auto"></div>
                            <p class="mt-1">Maestro(a) de Grupo</p>
                        </div>
                        <div class="text-center">
                            <div class="border-t border-gray-400 w-48 mx-auto"></div>
                            <p class="mt-1">Director(a) de la Escuela</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <p class="text-sm font-semibold">Notas:</p>
                        <div class="border-b border-gray-400 h-12"></div>
                        <div class="border-b border-gray-400 h-12"></div>
                    </div>
                </div>
            @elseif($gradoSeleccionado && $grupoSeleccionado)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    No hay alumnos registrados en el grupo {{ $gradoSeleccionado }}° "{{ $grupoSeleccionado }}".
                </div>
            @endif
        </div>
    </div>
    @push('styles')
<style>
    @media print {
        /* Ocultar todo lo que no sea el listado */
        .no-print, nav, header, footer, .btn, button:not(.print-btn), a:not(.print-link) {
            display: none !important;
        }
        
        /* Mostrar solo el listado */
        .print-only {
            display: block !important;
        }
        
        body {
            background: white !important;
            padding: 0 !important;
        }
        
        .max-w-7xl {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .bg-white {
            box-shadow: none !important;
            padding: 0 !important;
        }
        
        table {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        
        th, td {
            border: 1px solid #000 !important;
            padding: 2px 4px !important;
            font-size: 10px !important;
        }
        
        th {
            background: #f0f0f0 !important;
            color: #000 !important;
        }
        
        @page {
            size: letter;
            margin: 0.5cm;
        }
    }
</style>
@endpush
</x-app-layout>