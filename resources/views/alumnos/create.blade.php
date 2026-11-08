<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Nuevo Alumno
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

                    <form action="{{ route('alumnos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- ========================================== -->
                        <!-- DATOS PERSONALES -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">👤 Datos Personales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nombre(s) *</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Apellidos *</label>
                                    <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">CURP *</label>
                                    <input type="text" name="curp" value="{{ old('curp') }}" maxlength="18" class="w-full border border-gray-300 rounded-lg px-4 py-2 font-mono" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Fecha de Nacimiento *</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Lugar de Nacimiento</label>
                                    <input type="text" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Sexo</label>
                                    <select name="sexo" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="">Seleccionar</option>
                                        <option value="H" {{ old('sexo') == 'H' ? 'selected' : '' }}>Hombre</option>
                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Mujer</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nacionalidad</label>
                                    <input type="text" name="nacionalidad" value="{{ old('nacionalidad', 'Mexicana') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- ========================================== -->
                        <!-- DATOS ESCOLARES -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📚 Datos Escolares</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                               <div>
    <label class="block text-gray-700 font-semibold mb-2">Matrícula</label>
    <input type="text" value="Se generará automáticamente" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" readonly>
</div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Grado *</label>
                                    <input type="text" name="grado" value="{{ old('grado') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Grupo *</label>
                                    <input type="text" name="grupo" value="{{ old('grupo') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Turno</label>
                                    <select name="turno" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="Matutino" {{ old('turno') == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                        <option value="Vespertino" {{ old('turno') == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Fecha de Inscripción *</label>
                                    <input type="date" name="fecha_inscripcion" value="{{ old('fecha_inscripcion') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Tipo de Inscripción</label>
                                    <select name="tipo_inscripcion" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        <option value="Nuevo ingreso" {{ old('tipo_inscripcion') == 'Nuevo ingreso' ? 'selected' : '' }}>Nuevo ingreso</option>
                                        <option value="Reinscripción" {{ old('tipo_inscripcion') == 'Reinscripción' ? 'selected' : '' }}>Reinscripción</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Estatus *</label>
                                    <select name="estatus" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                        <option value="Regular" {{ old('estatus') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('estatus') == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                    </select>
                                </div>
                            </div>
                        </div>
<!-- ========================================== -->
<!-- MULTIMEDIA -->
<!-- ========================================== -->
<div class="mb-6">
    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📸 Multimedia</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Foto del Alumno</label>
            <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            <small class="text-gray-500">Formatos: JPG, PNG (máx. 2MB)</small>
        </div>
       
    </div>
</div>

                        <!-- ========================================== -->
                        <!-- DOCUMENTACIÓN -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📄 Documentación</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">PDF de Documentos</label>
                                    <input type="file" name="pdf_documentos" accept=".pdf" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    <small class="text-gray-500">Un solo PDF con todos los documentos escaneados</small>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Estatus de Documentos *</label>
                                    <select name="estatus_documentos" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                        <option value="Incompleto" {{ old('estatus_documentos') == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
                                        <option value="Completo" {{ old('estatus_documentos') == 'Completo' ? 'selected' : '' }}>Completo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================== -->
                        <!-- DATOS MÉDICOS -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">🏥 Datos Médicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Alergias</label>
                                    <textarea name="alergias" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('alergias') }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Enfermedades Crónicas</label>
                                    <textarea name="enfermedades_cronicas" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('enfermedades_cronicas') }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Medicamentos</label>
                                    <textarea name="medicamentos" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ old('medicamentos') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Seguro Médico</label>
                                    <input type="text" name="seguro_medico" value="{{ old('seguro_medico') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- ========================================== -->
                        <!-- CONTACTO DE EMERGENCIA -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📞 Contacto de Emergencia</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nombre del Contacto</label>
                                    <input type="text" name="contacto_emergencia_nombre" value="{{ old('contacto_emergencia_nombre') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Teléfono del Contacto</label>
                                    <input type="text" name="contacto_emergencia_telefono" value="{{ old('contacto_emergencia_telefono') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>
                        </div>

                        <!-- ========================================== -->
                        <!-- OBSERVACIONES -->
                        <!-- ========================================== -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📝 Observaciones</h3>
                            <textarea name="observaciones" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="3">{{ old('observaciones') }}</textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                💾 Guardar Alumno
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
</x-app-layout>
