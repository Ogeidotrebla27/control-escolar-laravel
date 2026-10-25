@extends('layouts.app')

@section('title', 'Editar Alumno')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">✏️ Editar Alumno</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nombre *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Apellidos *</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">CURP *</label>
                <input type="text" name="curp" value="{{ old('curp', $alumno->curp) }}" maxlength="18"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono"
                       required>
                <small class="text-gray-500 text-sm">18 caracteres</small>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Grado *</label>
                    <input type="text" name="grado" value="{{ old('grado', $alumno->grado) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Grupo *</label>
                    <input type="text" name="grupo" value="{{ old('grupo', $alumno->grupo) }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    💾 Actualizar Alumno
                </button>
                <a href="{{ route('alumnos.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
