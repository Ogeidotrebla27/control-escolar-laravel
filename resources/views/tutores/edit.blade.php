<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Tutor
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

                    <form action="{{ route('tutores.update', $tutor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Nombre(s) *</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $tutor->nombre) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Apellidos *</label>
                                <input type="text" name="apellidos" value="{{ old('apellidos', $tutor->apellidos) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">CURP *</label>
                                <input type="text" name="curp" value="{{ old('curp', $tutor->curp) }}" maxlength="18" class="w-full border border-gray-300 rounded-lg px-4 py-2 font-mono" required>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                                <input type="text" name="telefono" value="{{ old('telefono', $tutor->telefono) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                                <input type="email" name="email" value="{{ old('email', $tutor->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-semibold mb-2">Dirección</label>
                                <input type="text" name="direccion" value="{{ old('direccion', $tutor->direccion) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Ocupación</label>
                                <input type="text" name="ocupacion" value="{{ old('ocupacion', $tutor->ocupacion) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lugar de Trabajo</label>
                                <input type="text" name="lugar_trabajo" value="{{ old('lugar_trabajo', $tutor->lugar_trabajo) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                💾 Actualizar Tutor
                            </button>
                            <a href="{{ route('tutores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
