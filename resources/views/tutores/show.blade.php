<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👤 Detalle del Tutor
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('tutores.edit', $tutor->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    ✏️ Editar
                </a>
                <a href="{{ route('tutores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    ← Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-4">
                        {{ $tutor->nombre }} {{ $tutor->apellidos }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-sm">
                        <div>
                            <p class="mb-2"><strong>CURP:</strong> <span class="font-mono">{{ $tutor->curp }}</span></p>
                            <p class="mb-2"><strong>Teléfono:</strong> {{ $tutor->telefono ?? '—' }}</p>
                            <p class="mb-2"><strong>Correo:</strong> {{ $tutor->email ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>Dirección:</strong> {{ $tutor->direccion ?? '—' }}</p>
                            <p class="mb-2"><strong>Ocupación:</strong> {{ $tutor->ocupacion ?? '—' }}</p>
                            <p class="mb-2"><strong>Lugar de Trabajo:</strong> {{ $tutor->lugar_trabajo ?? '—' }}</p>
                        </div>
                    </div>

                    <!-- SECCIÓN DE ALUMNOS VINCULADOS -->
                    <div class="mt-8 border-t pt-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">👨‍🎓 Alumnos a su cargo</h4>
                        
                        @if($tutor->alumnos->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($tutor->alumnos as $alumno)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-blue-900">{{ $alumno->apellidos }} {{ $alumno->nombre }}</p>
                                            <p class="text-xs text-gray-600">{{ $alumno->grado }}° "{{ $alumno->grupo }}"</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-[10px] uppercase font-bold">
                                                    {{ $alumno->pivot->tipo_relacion }}
                                                </span>
                                                @if($alumno->pivot->es_responsable)
                                                    <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-[10px] uppercase font-bold ml-1">
                                                        Responsable
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <a href="{{ route('alumnos.show', $alumno->id) }}" class="text-blue-600 hover:text-blue-900 text-sm font-semibold">Ver Ficha →</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded">
                                Este tutor aún no tiene alumnos vinculados en el sistema.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
