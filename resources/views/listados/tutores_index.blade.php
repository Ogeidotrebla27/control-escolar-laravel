<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👨‍👩‍👧 Listados de Tutores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- LISTADO POR GRUPO -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Listado por Grupo</h3>
                <form method="GET" action="{{ route('listados.tutores.print') }}" target="_blank" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Grado</label>
                        <select name="grado" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            @foreach($grupos->unique('grado') as $grupo)
                                <option value="{{ $grupo->grado }}">{{ $grupo->grado }}°</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Grupo</label>
                        <select name="grupo" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            @foreach($grupos->unique('grupo') as $grupo)
                                <option value="{{ $grupo->grupo }}">{{ $grupo->grupo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alumnos</label>
                        <select name="filtro" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="todos">Todos</option>
                            <option value="regulares">Solo Regulares</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo de Lista</label>
                        <select name="tipo_lista" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="todos">Completo (Padres y Tutores)</option>
                            <option value="responsables">Solo Responsables (Juntas)</option>
                        </select>
                    </div>

                    <div class="flex items-end md:col-span-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold w-full">
                            🖨️ Imprimir Lista de Grupo
                        </button>
                    </div>
                </form>
            </div>

            <!-- LISTADO GENERAL -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Listado General de Tutores</h3>
                <p class="text-sm text-gray-500 mb-4">Genera un listado con todos los tutores de la escuela. Si un tutor tiene varios hijos, aparecerá solo una vez (en el grupo de su hijo mayor).</p>
                
                <form method="GET" action="{{ route('listados.tutores.general') }}" target="_blank" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Filtrar Alumnos</label>
                        <select name="filtro" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="todos">Todos los inscritos</option>
                            <option value="regulares">Solo Alumnos Regulares</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo de Lista</label>
                        <select name="tipo_lista" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="todos">Completo (Padres y Tutores)</option>
                            <option value="responsables">Solo Responsables (Juntas)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg font-semibold w-full">
                            🖨️ Imprimir Listado General
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>