@extends('layouts.app')

@section('title', 'Detalle del Alumno')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">👤 Detalle del Alumno</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="space-y-4">
            <div class="border-b border-gray-200 pb-3">
                <span class="text-sm text-gray-500 uppercase font-semibold">Nombre completo</span>
                <p class="text-xl font-bold text-gray-800">{{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
            </div>

            <div class="border-b border-gray-200 pb-3">
                <span class="text-sm text-gray-500 uppercase font-semibold">CURP</span>
                <p class="text-lg font-mono text-gray-800">{{ $alumno->curp }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 border-b border-gray-200 pb-3">
                <div>
                    <span class="text-sm text-gray-500 uppercase font-semibold">Grado</span>
                    <p class="text-lg font-bold text-gray-800">{{ $alumno->grado }}°</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 uppercase font-semibold">Grupo</span>
                    <p class="text-lg font-bold text-gray-800">{{ $alumno->grupo }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-sm text-gray-500 uppercase font-semibold">Registrado</span>
                    <p class="text-sm text-gray-700">{{ $alumno->created_at }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500 uppercase font-semibold">Última actualización</span>
                    <p class="text-sm text-gray-700">{{ $alumno->updated_at }}</p>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-8">
            <a href="{{ route('alumnos.edit', $alumno->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                ✏️ Editar
            </a>
            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition"
                        onclick="return confirm('¿Eliminar este alumno?')">
                    🗑️ Eliminar
                </button>
            </form>
            <a href="{{ route('alumnos.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                ← Volver
            </a>
        </div>
    </div>
</div>
@endsection
