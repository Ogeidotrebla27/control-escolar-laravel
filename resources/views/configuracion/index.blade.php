<x-app-layout>

@section('title', 'Configuración del Sistema')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">⚙️ Configuración del Sistema</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('configuracion.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Datos de la Escuela -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">🏫 Datos de la Escuela</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nombre de la Escuela *</label>
                    <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela', $config->nombre_escuela) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">C.C.T.</label>
                    <input type="text" name="clave_centro_trabajo" value="{{ old('clave_centro_trabajo', $config->clave_centro_trabajo) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Zona Escolar</label>
                    <input type="text" name="zona_escolar" value="{{ old('zona_escolar', $config->zona_escolar) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Sector Educativo</label>
                    <input type="text" name="sector_educativo" value="{{ old('sector_educativo', $config->sector_educativo) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $config->direccion) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $config->telefono) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $config->email) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Lema</label>
                    <input type="text" name="lema" value="{{ old('lema', $config->lema) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Logo</label>
                    @if($config->logo && file_exists(public_path($config->logo)))
                        <img src="{{ asset($config->logo) }}" alt="Logo" class="h-16 mb-2">
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>
        </div>

        <!-- Autoridades -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">👤 Autoridades</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Director(a)</label>
                    <input type="text" name="director_nombre" value="{{ old('director_nombre', $config->director_nombre) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Cédula del Director</label>
                    <input type="text" name="director_cedula" value="{{ old('director_cedula', $config->director_cedula) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Supervisor(a)</label>
                    <input type="text" name="supervisor_nombre" value="{{ old('supervisor_nombre', $config->supervisor_nombre) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Jefe(a) de Sector</label>
                    <input type="text" name="jefe_sector_nombre" value="{{ old('jefe_sector_nombre', $config->jefe_sector_nombre) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Oficina de CREDE</label>
                    <input type="text" name="crede_oficina" value="{{ old('crede_oficina', $config->crede_oficina) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>
        </div>

        <!-- Ciclo Escolar -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📅 Ciclo Escolar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Inicio del Ciclo</label>
                    <input type="date" name="ciclo_inicio" value="{{ old('ciclo_inicio', $config->ciclo_inicio) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Fin del Ciclo</label>
                    <input type="date" name="ciclo_fin" value="{{ old('ciclo_fin', $config->ciclo_fin) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Ciclo Actual (automático)</label>
                    <input type="text" value="{{ $config->ciclo_actual ?? 'Se calculará al guardar' }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100" readonly>
                </div>
            </div>
        </div>

        <!-- Remitente y Firmas -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">✍️ Remitente y Firmas</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nombre del Remitente</label>
                    <input type="text" name="remitente_nombre" value="{{ old('remitente_nombre', $config->remitente_nombre) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Cargo del Remitente</label>
                    <input type="text" name="remitente_cargo" value="{{ old('remitente_cargo', $config->remitente_cargo) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Firma del Director (PNG)</label>
                    @if($config->firma_director && file_exists(public_path($config->firma_director)))
                        <img src="{{ asset($config->firma_director) }}" alt="Firma" class="h-12 mb-2">
                    @endif
                    <input type="file" name="firma_director" accept="image/png" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Sello de la Escuela (PNG)</label>
                    @if($config->sello_escuela && file_exists(public_path($config->sello_escuela)))
                        <img src="{{ asset($config->sello_escuela) }}" alt="Sello" class="h-12 mb-2">
                    @endif
                    <input type="file" name="sello_escuela" accept="image/png" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                💾 Guardar Configuración
            </button>
        </div>
    </form>
</div>
</x-app-layout>
