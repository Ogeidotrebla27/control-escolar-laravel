<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👤 Detalle del Alumno
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('alumnos.edit', $alumno->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    ✏️ Editar
                </a>
                <a href="{{ route('alumnos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    ← Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- ENCABEZADO CON FOTO -->
                    <div class="flex flex-col md:flex-row gap-6 border-b pb-6 mb-6">
                        <div class="flex-shrink-0 text-center">
                            @if($alumno->foto && file_exists(public_path($alumno->foto)))
                                <img src="{{ asset($alumno->foto) }}" alt="Foto" 
                                     class="w-32 h-40 object-cover border-2 border-blue-900 rounded-lg mx-auto">
                            @else
                                <div class="w-32 h-40 bg-gray-100 border-2 border-blue-900 rounded-lg flex items-center justify-center mx-auto">
                                    <span class="text-gray-400 text-4xl">👤</span>
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Tamaño infantil</p>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h3>
                            <p class="text-gray-600">{{ $alumno->grado }}° "{{ $alumno->grupo }}" - Turno {{ $alumno->turno }}</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $alumno->estatus == 'Regular' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $alumno->estatus }}
                                </span>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $alumno->estatus_documentos == 'Completo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    Docs: {{ $alumno->estatus_documentos }}
                                </span>
                            </div>
                            <div class="mt-4 text-sm text-gray-600">
                                <p><strong>CURP:</strong> {{ $alumno->curp }}</p>
                                <p><strong>Matrícula:</strong> {{ $alumno->matricula ?? '—' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- DATOS PERSONALES -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">👤 Datos Personales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <p><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
                            <p><strong>Lugar de Nacimiento:</strong> {{ $alumno->lugar_nacimiento ?? '—' }}</p>
                            <p><strong>Sexo:</strong> {{ $alumno->sexo == 'H' ? 'Hombre' : ($alumno->sexo == 'M' ? 'Mujer' : '—') }}</p>
                            <p><strong>Nacionalidad:</strong> {{ $alumno->nacionalidad ?? 'Mexicana' }}</p>
                        </div>
                    </div>

                    <!-- DATOS ESCOLARES -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">📚 Datos Escolares</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <p><strong>Grado:</strong> {{ $alumno->grado }}°</p>
                            <p><strong>Grupo:</strong> {{ $alumno->grupo }}</p>
                            <p><strong>Turno:</strong> {{ $alumno->turno }}</p>
                            <p><strong>Fecha de Inscripción:</strong> {{ $alumno->fecha_inscripcion }}</p>
                            <p><strong>Tipo de Inscripción:</strong> {{ $alumno->tipo_inscripcion }}</p>
                            <p><strong>Estatus:</strong> {{ $alumno->estatus }}</p>
                        </div>
                    </div>

                    <!-- DATOS MÉDICOS -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">🏥 Datos Médicos</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <p><strong>Alergias:</strong> {{ $alumno->alergias ?? 'Ninguna' }}</p>
                            <p><strong>Enfermedades Crónicas:</strong> {{ $alumno->enfermedades_cronicas ?? 'Ninguna' }}</p>
                            <p><strong>Medicamentos:</strong> {{ $alumno->medicamentos ?? 'Ninguno' }}</p>
                            <p><strong>Seguro Médico:</strong> {{ $alumno->seguro_medico ?? '—' }}</p>
                        </div>
                    </div>

                    <!-- CONTACTO DE EMERGENCIA -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">📞 Contacto de Emergencia</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <p><strong>Nombre:</strong> {{ $alumno->contacto_emergencia_nombre ?? '—' }}</p>
                            <p><strong>Teléfono:</strong> {{ $alumno->contacto_emergencia_telefono ?? '—' }}</p>
                        </div>
                    </div>

                    <!-- DOCUMENTOS -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">📄 Documentos</h4>
                        <div class="text-sm">
                            <p><strong>Estatus:</strong> 
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $alumno->estatus_documentos == 'Completo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $alumno->estatus_documentos }}
                                </span>
                            </p>
                            @if($alumno->pdf_documentos && file_exists(public_path($alumno->pdf_documentos)))
                                <a href="{{ asset($alumno->pdf_documentos) }}" target="_blank" class="inline-block mt-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                                    📄 Ver PDF de Documentos
                                </a>
                            @else
                                <p class="text-gray-500 mt-2">No hay documentos subidos</p>
                            @endif
                        </div>
                    </div>

                    <!-- OBSERVACIONES -->
                    @if($alumno->observaciones)
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">📝 Observaciones</h4>
                        <p class="text-sm">{{ $alumno->observaciones }}</p>
                    </div>
                    @endif

                        <a href="{{ route('alumnos.print', ['id' => $alumno->id, 'tipo' => 'con_calificaciones']) }}" target="_blank" class="bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
        🖨️ Imprimir Ficha + Calificaciones
    </a>
<!-- HISTORIAL / BITÁCORA -->
<div class="mb-6 mt-8 border-t pt-6">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-bold text-gray-800">📖 Historial y Bitácora</h4>
        <a href="{{ route('bitacoras.create', ['alumno_id' => $alumno->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
            + Agregar Entrada
        </a>
    </div>

    @if($alumno->bitacoras->count() > 0)
        <div class="space-y-4">
            @foreach($alumno->bitacoras()->orderBy('created_at', 'desc')->get() as $bitacora)
                <div class="bg-gray-50 border-l-4 rounded-r-lg p-4 shadow-sm
                    @if($bitacora->categoria == 'conducta') border-red-500 
                    @elseif($bitacora->categoria == 'felicitacion') border-green-500
                    @elseif($bitacora->categoria == 'logro') border-yellow-500
                    @else border-blue-500 @endif">
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase mb-1
                                @if($bitacora->categoria == 'conducta') bg-red-200 text-red-800
                                @elseif($bitacora->categoria == 'felicitacion') bg-green-200 text-green-800
                                @elseif($bitacora->categoria == 'logro') bg-yellow-200 text-yellow-800
                                @else bg-blue-200 text-blue-800 @endif">
                                {{ str_replace('_', ' ', $bitacora->categoria) }}
                            </span>
                            <p class="text-sm text-gray-700 font-medium">{{ $bitacora->descripcion }}</p>
                        </div>
                        <div class="text-right text-xs text-gray-500">
                            <p>{{ $bitacora->created_at->format('d/m/Y H:i') }}</p>
                            <p>Por: {{ $bitacora->user->name ?? 'Sistema' }}</p>
                            @if($bitacora->archivo_evidencia)
                                <a href="{{ asset($bitacora->archivo_evidencia) }}" target="_blank" class="text-blue-600 hover:underline">📎 Evidencia</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-sm italic">No hay entradas registradas en la bitácora de este alumno.</p>
    @endif
</div>
                    <!-- TUTORES -->
<div class="mb-6">
    <h4 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">👨‍👩‍👧 Tutores / Padres de Familia</h4>
    @if($alumno->tutores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($alumno->tutores as $tutor)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm">
                    <p class="font-semibold text-blue-900">{{ $tutor->apellidos }} {{ $tutor->nombre }}</p>
                    <p class="text-gray-600 mt-1">
                        <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs uppercase font-bold">
                            {{ $tutor->pivot->tipo_relacion }}
                        </span>
                        @if($tutor->pivot->es_responsable)
                            <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs uppercase font-bold ml-1">
                                Responsable
                            </span>
                        @endif
                    </p>
                    <p class="text-gray-600 mt-1">Tel: {{ $tutor->telefono ?? '—' }}</p>
                    <p class="text-gray-600">CURP: {{ $tutor->curp }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-sm">No hay tutores registrados</p>
    @endif
</div>

                    <!-- PIE -->
                    <div class="border-t pt-4 text-xs text-gray-500 flex justify-between">
                        <span>Registrado: {{ $alumno->created_at }}</span>
                        <span>Última actualización: {{ $alumno->updated_at }}</span>
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
           <div class="flex gap-3 mt-8">
<div class="flex flex-wrap gap-2 mb-6 no-print">
    <!-- Botón 1: Solo datos -->
    <a href="{{ route('alumnos.print', ['id' => $alumno->id, 'tipo' => 'simple']) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
        🖨️ Ficha Simple
    </a>
    
    <!-- Botón 2: Datos + Bitácora -->
    <a href="{{ route('alumnos.print', ['id' => $alumno->id, 'tipo' => 'completa']) }}" target="_blank" class="bg-blue-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
        🖨️ Ficha + Historial
    </a>
    
    <!-- Botón 3: Solo Bitácora -->
    <a href="{{ route('alumnos.print', ['id' => $alumno->id, 'tipo' => 'historial']) }}" target="_blank" class="bg-blue-600 hover:bg-yellow-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
        🖨️ Solo Historial
    </a>
</div>

    <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition" onclick="return confirm('¿Eliminar este alumno?')">
            🗑️ Eliminar
        </button>
    </form>
    <a href="{{ route('alumnos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
        ← Volver al Listado
    </a>
</div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>