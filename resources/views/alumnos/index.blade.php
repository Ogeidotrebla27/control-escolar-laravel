<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📋 Listado de Alumnos
            </h2>
            <a href="{{ route('alumnos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                + Nuevo Alumno
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ESTADÍSTICAS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-blue-800">{{ $totalAlumnos }}</p>
                    <p class="text-xs text-blue-600 uppercase font-semibold">Total Alumnos</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-green-800">{{ $totalRegulares }}</p>
                    <p class="text-xs text-green-600 uppercase font-semibold">Regulares</p>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-yellow-800">{{ $totalIrregulares }}</p>
                    <p class="text-xs text-yellow-600 uppercase font-semibold">Irregulares</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-purple-800">{{ $totalHombres }} / {{ $totalMujeres }}</p>
                    <p class="text-xs text-purple-600 uppercase font-semibold">Hombres / Mujeres</p>
                </div>
            </div>

            <!-- FILTROS -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('alumnos.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-600 font-semibold mb-1">Buscar</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Nombre, CURP, matrícula..."
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 font-semibold mb-1">Grado</label>
                        <select name="grado" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ request('grado') == $i ? 'selected' : '' }}>{{ $i }}°</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 font-semibold mb-1">Grupo</label>
                        <select name="grupo" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $grupo)
                                <option value="{{ $grupo }}" {{ request('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 font-semibold mb-1">Estatus</label>
                        <select name="estatus" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="Regular" {{ request('estatus') == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Irregular" {{ request('estatus') == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                            Filtrar
                        </button>
                        <a href="{{ route('alumnos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- CONTADOR -->
            <p class="text-sm text-gray-600 mb-2">
                {{ $alumnos->count() }} alumno(s) encontrado(s)
                @if(request('search') || request('grado') || request('grupo') || request('estatus'))
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full ml-2">Filtros aplicados</span>
                @endif
            </p>

            <!-- TABLA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">CURP</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grado</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grupo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estatus</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Docs</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($alumnos as $alumno)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        @if($alumno->foto && file_exists(public_path($alumno->foto)))
                                            <img src="{{ asset($alumno->foto) }}" alt="Foto" class="w-10 h-12 object-cover rounded border">
                                        @else
                                            <div class="w-10 h-12 bg-gray-100 rounded border flex items-center justify-center text-gray-400 text-lg">👤</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $alumno->nombre }} {{ $alumno->apellidos }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 font-mono">{{ $alumno->curp }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $alumno->grado }}°</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $alumno->grupo }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $alumno->estatus == 'Regular' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $alumno->estatus }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $alumno->estatus_documentos == 'Completo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $alumno->estatus_documentos }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex gap-2">
                                            <a href="{{ route('alumnos.show', $alumno->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Ver</a>
                                            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="text-yellow-600 hover:text-yellow-900 font-semibold">Editar</a>
                                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="inline" 
                                                  onsubmit="return confirm('⚠️ ¿Estás seguro de eliminar a {{ $alumno->nombre }} {{ $alumno->apellidos }}?\n\nEsta acción no se puede deshacer.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        No hay alumnos registrados con los filtros seleccionados
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- PAGINACIÓN -->
<div class="mt-4">
    {{ $alumnos->links() }}
</div>
        </div>
    </div>
</x-app-layout>