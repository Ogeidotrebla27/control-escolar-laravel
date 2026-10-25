@extends('layouts.app')

@section('title', 'Listado de Alumnos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">📋 Listado de Alumnos</h2>
    <a href="{{ route('alumnos.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
        + Nuevo Alumno
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Nombre</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Apellidos</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">CURP</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Grado</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Grupo</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($alumnos as $alumno)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-sm">{{ $alumno->id }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $alumno->nombre }}</td>
                <td class="px-4 py-3 text-sm">{{ $alumno->apellidos }}</td>
                <td class="px-4 py-3 text-sm font-mono">{{ $alumno->curp }}</td>
                <td class="px-4 py-3 text-sm">{{ $alumno->grado }}</td>
                <td class="px-4 py-3 text-sm">{{ $alumno->grupo }}</td>
                <td class="px-4 py-3 text-sm">
                    <div class="flex gap-2">
                        <a href="{{ route('alumnos.show', $alumno->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                            Ver
                        </a>
                        <a href="{{ route('alumnos.edit', $alumno->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">
                            Editar
                        </a>
                        <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded"
                                    onclick="return confirm('¿Eliminar?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                    No hay alumnos registrados
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
