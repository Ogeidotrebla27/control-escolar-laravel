<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Listar todos los alumnos
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Guardar nuevo alumno
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:alumnos,curp',
            'grado' => 'required|string|max:10',
            'grupo' => 'required|string|max:10',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno creado correctamente.');
    }

    /**
     * Mostrar un alumno específico
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Actualizar alumno
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:alumnos,curp,' . $id,
            'grado' => 'required|string|max:10',
            'grupo' => 'required|string|max:10',
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno actualizado correctamente.');
    }

    /**
     * Eliminar alumno
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno eliminado correctamente.');
    }
}
