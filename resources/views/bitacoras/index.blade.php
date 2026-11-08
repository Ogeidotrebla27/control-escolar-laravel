<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📖 Bitácora Escolar
            </h2>
            <a href="{{ route('bitacoras.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                + Nueva Entrada
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

            <!-- FILTROS -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('bitacoras.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Filtrar por Tipo</label>
                        <select name="tipo" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="alumno" {{ request('tipo') == 'alumno' ? 'selected' : '' }}>Alumnos</option>
                            <option value="escuela" {{ request('tipo') == 'escuela' ? 'selected' : '' }}>Eventos de la Escuela</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Filtrar por Categoría</label>
                        <select name="categoria" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">Todas</option>
                            <option value="conducta" {{ request('categoria') == 'conducta' ? 'selected' : '' }}>Conducta</option>
                            <option value="felicitacion" {{ request('categoria') == 'felicitacion' ? 'selected' : '' }}>Felicitación</option>
                            <option value="participacion" {{ request('categoria') == 'participacion' ? 'selected' : '' }}>Participación</option>
                            <option value="atencion_padres" {{ request('categoria') == 'atencion_padres' ? 'selected' : '' }}>Atención a Padres</option>
                            <option value="logro" {{ request('categoria') == 'logro' ? 'selected' : '' }}>Logro Escolar</option>
                        </select>
                    </div>
                    <div class="flex items-end md:col-span-2 gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold w-full md:w-auto">Filtrar</button>
                        <a href="{{ route('bitacoras.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-semibold w-full md:w-auto text-center">Limpiar</a>
                    </div>
                </form>
            </div>

            <!-- LISTA DE BITÁCORAS -->
            <div class="space-y-4">
                @forelse($bitacoras as $bitacora)
                    <div class="bg-white rounded-lg shadow p-4 border-l-4 
                        @if($bitacora->categoria == 'conducta') border-red-500 
                        @elseif($bitacora->categoria == 'felicitacion') border-green-500
                        @elseif($bitacora->categoria == 'logro') border-yellow-500
                        @else border-blue-500 @endif">
                        
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="inline-block px-2 py-1 rounded text-xs font-bold uppercase mb-2
                                    @if($bitacora->categoria == 'conducta') bg-red-100 text-red-800
                                    @elseif($bitacora->categoria == 'felicitacion') bg-green-100 text-green-800
                                    @elseif($bitacora->categoria == 'logro') bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ str_replace('_', ' ', $bitacora->categoria) }}
                                </span>
                                
                                <h3 class="font-bold text-gray-800">
                                    @if($bitacora->entidad_type == 'App\Models\Alumno' && $bitacora->entidad)
                                        Alumno: {{ $bitacora->entidad->apellidos }} {{ $bitacora->entidad->nombre }}
                                    @else
                                        Evento General de la Escuela
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $bitacora->descripcion }}</p>
                            </div>
                            
                            <div class="text-right text-xs text-gray-500">
                                <p>Registrado por: <strong>{{ $bitacora->user->name ?? 'Sistema' }}</strong></p>
                                <p>{{ $bitacora->created_at->format('d/m/Y H:i') }}</p>
                                
                                @if($bitacora->archivo_evidencia)
                                    <a href="{{ asset($bitacora->archivo_evidencia) }}" target="_blank" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-semibold">
                                        📎 Ver Evidencia
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                        No hay registros en la bitácora con los filtros seleccionados.
                    </div>
                @endforelse
            </div>

            <!-- PAGINACIÓN -->
            <div class="mt-6">
                {{ $bitacoras->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
