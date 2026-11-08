<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Nueva Entrada de Bitácora
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('bitacoras.store') }}" method="POST" enctype="multipart/form-data" x-data="nuevaBitacora">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            
                            <!-- Tipo de Entrada -->
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">¿A quién va dirigida esta entrada? *</label>
                                <select name="tipo_entidad" x-model="tipoEntidad" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                    <option value="alumno">A un Alumno</option>
                                    <option value="escuela">Evento General de la Escuela</option>
                                </select>
                            </div>

                            <!-- Buscador de Alumnos (Solo se muestra si es para un alumno) -->
                            <div class="md:col-span-2 relative" x-show="tipoEntidad === 'alumno'" x-transition>
                                <label class="block text-gray-700 font-semibold mb-2">Buscar Alumno *</label>
                                
                                <!-- Si ya viene un alumno pre-seleccionado -->
                                <input type="hidden" name="alumno_id" x-model="alumnoSeleccionadoId">
                                
                                <div x-show="!alumnoSeleccionadoId">
                                    <input type="text" x-model="busqueda" @input.debounce.300ms="buscarAlumnos()" placeholder="Escribe el nombre o apellido del alumno..." class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    
                                    <ul x-show="resultados.length > 0" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-lg max-h-60 overflow-y-auto" style="display: none;">
                                        <template x-for="alumno in resultados" :key="alumno.id">
                                            <li @click="seleccionarAlumno(alumno)" class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-0">
                                                <span class="font-semibold" x-text="alumno.apellidos + ' ' + alumno.nombre"></span>
                                                <span class="text-xs text-gray-500 block" x-text="'Grupo: ' + alumno.grado + '°' + alumno.grupo"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>

                                <!-- Alumno seleccionado -->
                                <div x-show="alumnoSeleccionadoId" class="bg-blue-50 border border-blue-200 rounded-lg p-3 flex justify-between items-center">
                                    <span class="font-bold text-blue-900" x-text="alumnoNombre"></span>
                                    <button type="button" @click="quitarAlumno()" class="text-red-600 text-sm font-semibold">Cambiar</button>
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Categoría *</label>
                                <select name="categoria" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                    <option value="conducta">Llamado de Atención / Conducta</option>
                                    <option value="felicitacion">Felicitación</option>
                                    <option value="participacion">Participación en Evento</option>
                                    <option value="atencion_padres">Atención a Padres</option>
                                    <option value="logro">Logro Escolar</option>
                                    <option value="infraestructura">Infraestructura</option>
                                </select>
                            </div>

                            <!-- Evidencia -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Evidencia (Foto o PDF)</label>
                                <input type="file" name="archivo_evidencia" accept="image/*,.pdf" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                <small class="text-gray-500">Opcional. Ej. Reporte firmado o foto.</small>
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Descripción de los hechos *</label>
                                <textarea name="descripcion" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="4" required>{{ old('descripcion') }}</textarea>
                            </div>

                            <!-- Notificar a padres -->
                            <div class="md:col-span-2 flex items-center gap-2">
                                <input type="checkbox" name="notificar_padres" value="1" class="w-4 h-4 text-blue-600 rounded">
                                <label class="text-sm text-gray-600">Mostrar esta entrada en el tablón de avisos para los padres</label>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                💾 Guardar Entrada
                            </button>
                            <a href="{{ route('bitacoras.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nuevaBitacora', () => ({
                tipoEntidad: '{{ $alumno ? 'alumno' : 'escuela' }}',
                busqueda: '',
                resultados: [],
                alumnoSeleccionadoId: '{{ $alumno ? $alumno->id : '' }}',
                alumnoNombre: '{{ $alumno ? $alumno->apellidos . " " . $alumno->nombre : '' }}',
                
                async buscarAlumnos() {
                    if (this.busqueda.length < 2) {
                        this.resultados = [];
                        return;
                    }
                    try {
                        const response = await fetch(`/alumnos/buscar?q=${this.busqueda}`);
                        this.resultados = await response.json();
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },

                seleccionarAlumno(alumno) {
                    this.alumnoSeleccionadoId = alumno.id;
                    this.alumnoNombre = alumno.apellidos + ' ' + alumno.nombre;
                    this.busqueda = '';
                    this.resultados = [];
                },

                quitarAlumno() {
                    this.alumnoSeleccionadoId = '';
                    this.alumnoNombre = '';
                }
            }));
        });
    </script>
</x-app-layout>
