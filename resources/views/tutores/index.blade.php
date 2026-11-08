<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👨‍👩‍👧 Listado de Tutores
            </h2>
            <a href="{{ route('tutores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                + Nuevo Tutor
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

            <!-- BUSCADOR -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('tutores.index') }}" class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, apellidos o CURP..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold">Buscar</button>
                    <a href="{{ route('tutores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-semibold">Limpiar</a>
                </form>
            </div>

            <!-- TABLA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre Completo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">CURP</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alumnos a su cargo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($tutores as $tutor)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $tutor->apellidos }} {{ $tutor->nombre }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500 font-mono">{{ $tutor->curp }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $tutor->telefono ?? '—' }}</td>
                                    
                                    <!-- NUEVA COLUMNA DE ALUMNOS -->
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        @if($tutor->alumnos->count() > 0)
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach($tutor->alumnos as $alumno)
                                                    <li>
                                                        <span class="font-medium text-gray-700">{{ $alumno->apellidos }} {{ $alumno->nombre }}</span>
                                                        <span class="text-xs text-gray-500">({{ $alumno->grado }}°{{ $alumno->grupo }})</span>
                                                        @if($alumno->pivot->es_responsable)
                                                            <span class="bg-green-100 text-green-800 px-1 py-0.5 rounded text-[9px] uppercase font-bold ml-1">Resp.</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400 italic">Sin alumnos vinculados</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex gap-2">
                                            <a href="{{ route('tutores.show', $tutor->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Ver</a>
                                            <a href="{{ route('tutores.edit', $tutor->id) }}" class="text-yellow-600 hover:text-yellow-900 font-semibold">Editar</a>
                                            <form action="{{ route('tutores.destroy', $tutor->id) }}" method="POST" class="inline" onsubmit="return confirm('⚠️ ¿Estás seguro de eliminar a {{ $tutor->nombre }} {{ $tutor->apellidos }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay tutores registrados</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- PAGINACIÓN -->
                    <div class="mt-4">
                        {{ $tutores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>