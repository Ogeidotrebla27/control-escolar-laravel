<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Alumno;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    /**
     * Listar las bitácoras
     */
    public function index(Request $request)
    {
        $query = Bitacora::with(['entidad', 'user'])->orderBy('created_at', 'desc');

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por tipo de entidad (Alumno, Escuela, etc.)
        if ($request->filled('tipo')) {
            if ($request->tipo == 'escuela') {
                $query->whereNull('entidad_id')->orWhere('entidad_type', 'App\Models\Escuela');
            } else {
                $query->where('entidad_type', 'App\Models\Alumno');
            }
        }

        $bitacoras = $query->paginate(15);
        return view('bitacoras.index', compact('bitacoras'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create(Request $request)
    {
        // Si viene desde la ficha de un alumno, pre-seleccionamos los datos
        $alumno = null;
        if ($request->filled('alumno_id')) {
            $alumno = Alumno::findOrFail($request->alumno_id);
        }

        return view('bitacoras.create', compact('alumno'));
    }

    /**
     * Guardar nueva bitácora
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string',
            'descripcion' => 'required|string',
            'archivo_evidencia' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'notificar_padres' => 'boolean',
            'tipo_entidad' => 'required|in:alumno,escuela,personal',
            'alumno_id' => 'required_if:tipo_entidad,alumno|exists:alumnos,id',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        // Asignar la entidad (Relación Polimórfica)
        if ($request->tipo_entidad == 'alumno') {
            $data['entidad_id'] = $request->alumno_id;
            $data['entidad_type'] = 'App\Models\Alumno';
        } elseif ($request->tipo_entidad == 'escuela') {
            $data['entidad_id'] = null;
            $data['entidad_type'] = 'App\Models\Escuela'; // Simulamos el modelo Escuela
        }

        // Guardar archivo de evidencia
        if ($request->hasFile('archivo_evidencia')) {
            $file = $request->file('archivo_evidencia');
            $nombreArchivo = 'evidencia_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bitacoras'), $nombreArchivo);
            $data['archivo_evidencia'] = 'uploads/bitacoras/' . $nombreArchivo;
        }

        Bitacora::create($data);

        return redirect()->route('bitacoras.index')
                         ->with('success', 'Entrada de bitácora registrada correctamente.');
    }

    /**
     * Mostrar una entrada específica
     */
    public function show($id)
    {
        $bitacora = Bitacora::with(['entidad', 'user'])->findOrFail($id);
        return view('bitacoras.show', compact('bitacora'));
    }

    /**
     * Eliminar entrada
     */
    public function destroy($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        
        if ($bitacora->archivo_evidencia && file_exists(public_path($bitacora->archivo_evidencia))) {
            unlink(public_path($bitacora->archivo_evidencia));
        }
        
        $bitacora->delete();

        return redirect()->route('bitacoras.index')
                         ->with('success', 'Entrada de bitácora eliminada correctamente.');
    }

    // Los métodos edit y update no se usan en bitácora (solo se agregan y se leen)
    public function edit($id) {}
    public function update(Request $request, $id) {}
}