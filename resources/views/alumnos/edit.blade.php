<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Alumno
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                    <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- DATOS PERSONALES -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">👤 Datos Personales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nombre(s) *</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Apellidos *</label>
                                    <input type="text" name="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">CURP *</label>
                                    <input type="text" name="curp" value="{{ old('curp', $alumno->curp) }}" maxlength="18" class="w-full border border-gray-300 rounded-lg px-4 py-2 font-mono" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Fecha de Nacimiento *</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Lugar de Nacimiento</label>
                                    <input type="text" name="lugar_nacimiento" value="{{ old('lugar_nacimiento', $alumno->lugar_nacimiento) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Sexo</label>
                                    <select name="sexo" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="">Seleccionar</option>
                                        <option value="H" {{ old('sexo', $alumno->sexo) == 'H' ? 'selected' : '' }}>Hombre</option>
                                        <option value="M" {{ old('sexo', $alumno->sexo) == 'M' ? 'selected' : '' }}>Mujer</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nacionalidad</label>
                                    <input type="text" name="nacionalidad" value="{{ old('nacionalidad', $alumno->nacionalidad) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- DATOS ESCOLARES -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📚 Datos Escolares</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Matrícula</label>
                                    <input type="text" value="{{ $alumno->matricula }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Grado *</label>
                                    <input type="text" name="grado" value="{{ old('grado', $alumno->grado) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Grupo *</label>
                                    <input type="text" name="grupo" value="{{ old('grupo', $alumno->grupo) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Turno</label>
                                    <select name="turno" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="Matutino" {{ old('turno', $alumno->turno) == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                        <option value="Vespertino" {{ old('turno', $alumno->turno) == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Fecha de Inscripción *</label>
                                    <input type="date" name="fecha_inscripcion" value="{{ old('fecha_inscripcion', $alumno->fecha_inscripcion) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tipo de Inscripción</label>
                                    <select name="tipo_inscripcion" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="Nuevo ingreso" {{ old('tipo_inscripcion', $alumno->tipo_inscripcion) == 'Nuevo ingreso' ? 'selected' : '' }}>Nuevo ingreso</option>
                                        <option value="Reinscripción" {{ old('tipo_inscripcion', $alumno->tipo_inscripcion) == 'Reinscripción' ? 'selected' : '' }}>Reinscripción</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Estatus *</label>
                                    <select name="estatus" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                        <option value="Regular" {{ old('estatus', $alumno->estatus) == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('estatus', $alumno->estatus) == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- DOCUMENTACIÓN -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📄 Documentación</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">PDF de Documentos</label>
                                    @if($alumno->pdf_documentos && file_exists(public_path($alumno->pdf_documentos)))
                                        <div class="mb-2">
                                            <a href="{{ asset($alumno->pdf_documentos) }}" target="_blank" class="text-blue-600 hover:text-blue-800">Ver PDF actual</a>
                                        </div>
                                    @endif
                                    <input type="file" name="pdf_documentos" accept=".pdf" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    <small class="text-gray-500">Dejar vacío para mantener el PDF actual</small>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Estatus de Documentos *</label>
                                    <select name="estatus_documentos" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                        <option value="Incompleto" {{ old('estatus_documentos', $alumno->estatus_documentos) == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
                                        <option value="Completo" {{ old('estatus_documentos', $alumno->estatus_documentos) == 'Completo' ? 'selected' : '' }}>Completo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- DATOS MÉDICOS -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">🏥 Datos Médicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Alergias</label>
                                    <textarea name="alergias" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('alergias', $alumno->alergias) }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Enfermedades Crónicas</label>
                                    <textarea name="enfermedades_cronicas" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('enfermedades_cronicas', $alumno->enfermedades_cronicas) }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Medicamentos</label>
                                    <textarea name="medicamentos" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('medicamentos', $alumno->medicamentos) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Seguro Médico</label>
                                    <input type="text" name="seguro_medico" value="{{ old('seguro_medico', $alumno->seguro_medico) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- CONTACTO DE EMERGENCIA -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📞 Contacto de Emergencia</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nombre del Contacto</label>
                                    <input type="text" name="contacto_emergencia_nombre" value="{{ old('contacto_emergencia_nombre', $alumno->contacto_emergencia_nombre) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Teléfono del Contacto</label>
                                    <input type="text" name="contacto_emergencia_telefono" value="{{ old('contacto_emergencia_telefono', $alumno->contacto_emergencia_telefono) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- MULTIMEDIA -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📸 Multimedia</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Foto del Alumno</label>
                                    @if($alumno->foto && file_exists(public_path($alumno->foto)))
                                        <div class="mb-2">
                                            <img src="{{ asset($alumno->foto) }}" alt="Foto actual" class="h-20 w-16 object-cover border rounded">
                                        </div>
                                    @endif
                                    <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    <small class="text-gray-500">Dejar vacío para mantener la foto actual</small>
                                </div>
                            </div>
                        </div>

                        <!-- TUTORES VINCULADOS -->
                        <div class="mb-6 mt-6 border-t pt-6" x-data="buscadorTutores">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">👨‍👩‍👧 Tutores / Padres de Familia</h3>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="mb-4 relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Buscar y agregar tutor</label>
                                    <input type="text" x-model="busqueda" @input.debounce.300ms="buscar()" placeholder="Escribe el nombre o apellido del tutor..." class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    
                                    <ul x-show="resultados.length > 0" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-lg max-h-60 overflow-y-auto" style="display: none;">
                                        <template x-for="tutor in resultados" :key="tutor.id">
                                            <li @click="agregarTutor(tutor)" class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-0">
                                                <span class="font-semibold" x-text="tutor.apellidos + ' ' + tutor.nombre"></span>
                                                <span class="text-xs text-gray-500 block" x-text="'CURP: ' + tutor.curp"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>

                                <div class="mt-4">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Tutores asignados:</p>
                                    
                                    <template x-for="tutor in seleccionados" :key="tutor.id">
                                        <div class="flex flex-col md:flex-row items-start md:items-center gap-4 mb-3 p-3 bg-white border border-gray-200 rounded-lg shadow-sm">
                                            <div class="w-full md:w-1/3">
                                                <span class="font-semibold text-gray-800" x-text="tutor.apellidos + ' ' + tutor.nombre"></span>
                                                <input type="hidden" :name="'tutores[' + tutor.id + '][seleccionado]'" value="1">
                                            </div>

                                            <div class="w-full md:w-1/4">
                                                <select :name="'tutores[' + tutor.id + '][tipo_relacion]'" class="w-full border border-gray-300 rounded-lg px-2 py-1 text-sm">
                                                    <option value="Padre" :selected="tutor.pivot_tipo === 'Padre'">Padre</option>
                                                    <option value="Madre" :selected="tutor.pivot_tipo === 'Madre'">Madre</option>
                                                    <option value="Tutor" :selected="tutor.pivot_tipo === 'Tutor'">Tutor</option>
                                                </select>
                                            </div>

                                            <div class="flex items-center gap-2 w-full md:w-1/4">
                                                <input type="checkbox" :name="'tutores[' + tutor.id + '][es_responsable]'" value="1" class="w-4 h-4 text-green-600 rounded" :checked="tutor.pivot_responsable == 1">
                                                <label class="text-xs text-gray-600">Responsable</label>
                                            </div>

                                            <div class="flex items-center gap-2 w-full md:w-1/4">
                                                <input type="checkbox" :name="'tutores[' + tutor.id + '][vive_con_alumno]'" value="1" class="w-4 h-4 text-blue-600 rounded" :checked="tutor.pivot_vive == 1">
                                                <label class="text-xs text-gray-600">Vive con el alumno</label>
                                            </div>

                                            <div class="w-full md:w-auto text-right">
                                                <button type="button" @click="removerTutor(tutor.id)" class="text-red-600 hover:text-red-800 font-semibold text-sm">❌ Quitar</button>
                                            </div>
                                        </div>
                                    </template>

                                    <p x-show="seleccionados.length === 0" class="text-sm text-gray-500 italic">No hay tutores asignados.</p>
                                </div>
                            </div>
                        </div>

                        <!-- OBSERVACIONES -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📝 Observaciones</h3>
                            <textarea name="observaciones" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="3">{{ old('observaciones', $alumno->observaciones) }}</textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                💾 Actualizar Alumno
                            </button>
                            <a href="{{ route('alumnos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts al final del body -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('buscadorTutores', () => ({
                busqueda: '',
                resultados: [],
                seleccionados: {{ Js::from($tutoresVinculados) }},
                
                async buscar() {
                    if (this.busqueda.length < 2) {
                        this.resultados = [];
                        return;
                    }
                    try {
                        const response = await fetch(`/alumnos/buscar-tutores?q=${this.busqueda}`);
                        this.resultados = await response.json();
                    } catch (error) {
                        console.error('Error buscando tutores:', error);
                    }
                },

                agregarTutor(tutor) {
                    if (!this.seleccionados.find(t => t.id === tutor.id)) {
                        tutor.pivot_tipo = 'Tutor';
                        tutor.pivot_responsable = 0;
                        tutor.pivot_vive = 1;
                        this.seleccionados.push(tutor);
                    }
                    this.busqueda = '';
                    this.resultados = [];
                },

                removerTutor(id) {
                    this.seleccionados = this.seleccionados.filter(t => t.id !== id);
                }
            }));
        });
    </script>
</x-app-layout>