<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Tutor;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Listar todos los alumnos
     */
    public function index(Request $request)
{
    $query = Alumno::with('tutores');

    // Filtro por búsqueda (nombre, apellidos, CURP, matrícula)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('apellidos', 'LIKE', "%{$search}%")
              ->orWhere('curp', 'LIKE', "%{$search}%")
              ->orWhere('matricula', 'LIKE', "%{$search}%");
        });
    }

    // Filtro por grado
    if ($request->filled('grado')) {
        $query->where('grado', $request->grado);
    }

    // Filtro por grupo
    if ($request->filled('grupo')) {
        $query->where('grupo', $request->grupo);
    }

    // Filtro por estatus
    if ($request->filled('estatus')) {
        $query->where('estatus', $request->estatus);
    }

    // Filtro por estatus de documentos
    if ($request->filled('estatus_documentos')) {
        $query->where('estatus_documentos', $request->estatus_documentos);
    }

    $alumnos = $query->orderBy('apellidos')->paginate(20);

    // Estadísticas generales (siempre sobre TODOS los alumnos)
    $totalAlumnos = Alumno::count();
    $totalRegulares = Alumno::where('estatus', 'Regular')->count();
    $totalIrregulares = Alumno::where('estatus', 'Irregular')->count();
    $totalHombres = Alumno::where('sexo', 'H')->count();
    $totalMujeres = Alumno::where('sexo', 'M')->count();
    $totalDocsCompletos = Alumno::where('estatus_documentos', 'Completo')->count();
    $totalDocsIncompletos = Alumno::where('estatus_documentos', 'Incompleto')->count();

    return view('alumnos.index', compact(
        'alumnos',
        'totalAlumnos',
        'totalRegulares',
        'totalIrregulares',
        'totalHombres',
        'totalMujeres',
        'totalDocsCompletos',
        'totalDocsIncompletos'
    ));
}
    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $tutores = Tutor::orderBy('apellidos')->get();
        return view('alumnos.create', compact('tutores'));
    }

    /**
     * Guardar nuevo alumno
     */
public function store(Request $request)
{
    // 🔥 DIAGNÓSTICO TEMPORAL
    

    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'curp' => 'required|string|size:18|unique:alumnos,curp',
        'fecha_nacimiento' => 'required|date',
        'grado' => 'required|string|max:10',
        'grupo' => 'required|string|max:10',
        'fecha_inscripcion' => 'required|date',
        'estatus' => 'required|in:Regular,Irregular',
        'estatus_documentos' => 'required|in:Completo,Incompleto',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf_documentos' => 'nullable|file|mimes:pdf|max:5120',
    ]);

    $data = $request->except(['tutores']);

    // Generar matrícula automática
    $anio = date('Y');
    $ultimoAlumno = Alumno::whereYear('created_at', $anio)->orderBy('id', 'desc')->first();
    
    if ($ultimoAlumno && $ultimoAlumno->matricula) {
        $ultimoConsecutivo = intval(substr($ultimoAlumno->matricula, 4));
        $nuevoConsecutivo = $ultimoConsecutivo + 1;
    } else {
        $nuevoConsecutivo = 1;
    }
    
    $data['matricula'] = $anio . str_pad($nuevoConsecutivo, 4, '0', STR_PAD_LEFT);

    // Guardar foto
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nombreArchivo = 'foto_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/alumnos/fotos'), $nombreArchivo);
        $data['foto'] = 'uploads/alumnos/fotos/' . $nombreArchivo;
    }

    // Guardar PDF de documentos
    if ($request->hasFile('pdf_documentos')) {
        $file = $request->file('pdf_documentos');
        $nombreArchivo = 'documentos_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/alumnos/documentos'), $nombreArchivo);
        $data['pdf_documentos'] = 'uploads/alumnos/documentos/' . $nombreArchivo;
    }

    $data['user_id'] = auth()->id();

    // Capitalizar datos
$data['nombre'] = ucwords(strtolower($data['nombre']));
$data['apellidos'] = ucwords(strtolower($data['apellidos']));
if (isset($data['lugar_nacimiento'])) {
    $data['lugar_nacimiento'] = ucwords(strtolower($data['lugar_nacimiento']));
}
if (isset($data['observaciones'])) {
    $data['observaciones'] = ucfirst(strtolower($data['observaciones']));
}
if (isset($data['alergias'])) {
    $data['alergias'] = ucfirst(strtolower($data['alergias']));
}
if (isset($data['enfermedades_cronicas'])) {
    $data['enfermedades_cronicas'] = ucfirst(strtolower($data['enfermedades_cronicas']));
}
if (isset($data['medicamentos'])) {
    $data['medicamentos'] = ucfirst(strtolower($data['medicamentos']));
}
if (isset($data['contacto_emergencia_nombre'])) {
    $data['contacto_emergencia_nombre'] = ucwords(strtolower($data['contacto_emergencia_nombre']));
}

    Alumno::create($data);

    return redirect()->route('alumnos.index')
                     ->with('success', 'Alumno creado correctamente.');
}    /**
     * Mostrar un alumno específico
     */
    public function show($id)
{
    // Cargamos las relaciones 'tutores' y 'bitacoras'
    $alumno = Alumno::with(['tutores', 'bitacoras.user'])->findOrFail($id);
    return view('alumnos.show', compact('alumno'));
}

    public function edit($id)
{
    $alumno = Alumno::with('tutores')->findOrFail($id);
    $tutores = Tutor::orderBy('apellidos')->get(); 
    
    // Preparamos los tutores vinculados para el buscador de Alpine.js
    $tutoresVinculados = $alumno->tutores->map(function($t) {
        return [
            'id' => $t->id,
            'nombre' => $t->nombre,
            'apellidos' => $t->apellidos,
            'curp' => $t->curp,
            'pivot_tipo' => $t->pivot->tipo_relacion,
            'pivot_responsable' => $t->pivot->es_responsable,
            'pivot_vive' => $t->pivot->vive_con_alumno,
        ];
    });

    return view('alumnos.edit', compact('alumno', 'tutores', 'tutoresVinculados'));
}

    public function update(Request $request, $id)
{
    $alumno = Alumno::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'curp' => 'required|string|size:18|unique:alumnos,curp,' . $id,
        'fecha_nacimiento' => 'required|date',
        'grado' => 'required|string|max:10',
        'grupo' => 'required|string|max:10',
        'fecha_inscripcion' => 'required|date',
        'estatus' => 'required|in:Regular,Irregular',
        'estatus_documentos' => 'required|in:Completo,Incompleto',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf_documentos' => 'nullable|file|mimes:pdf|max:5120',
    ]);

    $data = $request->except(['tutores', 'foto', 'pdf_documentos']);

    // Guardar nueva foto
    if ($request->hasFile('foto')) {
        if ($alumno->foto && file_exists(public_path($alumno->foto))) {
            unlink(public_path($alumno->foto));
        }
        $file = $request->file('foto');
        $nombreArchivo = 'foto_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/alumnos/fotos'), $nombreArchivo);
        $data['foto'] = 'uploads/alumnos/fotos/' . $nombreArchivo;
    }

    // Guardar nuevo PDF
    if ($request->hasFile('pdf_documentos')) {
        if ($alumno->pdf_documentos && file_exists(public_path($alumno->pdf_documentos))) {
            unlink(public_path($alumno->pdf_documentos));
        }
        $file = $request->file('pdf_documentos');
        $nombreArchivo = 'documentos_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/alumnos/documentos'), $nombreArchivo);
        $data['pdf_documentos'] = 'uploads/alumnos/documentos/' . $nombreArchivo;
    }

    $alumno->update($data);

    // 🔥 GUARDAR TUTORES (Sincronización)
    $tutoresData = [];
    if ($request->has('tutores')) {
        foreach ($request->tutores as $tutorId => $tutorData) {
            // Solo guardar si se marcó el checkbox "seleccionado"
            if (isset($tutorData['seleccionado']) && $tutorData['seleccionado'] == 1) {
                $tutoresData[$tutorId] = [
                    'tipo_relacion' => $tutorData['tipo_relacion'] ?? 'Tutor',
                    'es_responsable' => isset($tutorData['es_responsable']) ? 1 : 0,
                    'vive_con_alumno' => isset($tutorData['vive_con_alumno']) ? 1 : 0,
                ];
            }
        }
    }
    
    // sync() actualiza la tabla pivote de una vez (quita los que ya no están y agrega los nuevos)
    $alumno->tutores()->sync($tutoresData);

    return redirect()->route('alumnos.index')
                     ->with('success', 'Alumno actualizado correctamente.');
}
    /**
 * Mostrar ficha para imprimir
 */
    public function print(Request $request, $id)
    {
        // Cargamos al alumno con sus tutores y sus bitácoras
        $alumno = Alumno::with(['tutores', 'bitacoras.user'])->findOrFail($id);
        
        // Leemos el tipo de impresión (por defecto será 'simple')
        $tipo = $request->input('tipo', 'simple'); 

        return view('alumnos.print', compact('alumno', 'tipo'));
    }
/**
 * Buscar tutores para el autocompletado (AJAX)
 */
public function buscarTutores(Request $request)
{
    $search = $request->input('q');
    
    if (empty($search)) {
        return response()->json([]);
    }

    $tutores = Tutor::where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellidos', 'LIKE', "%{$search}%")
                    ->orWhere('curp', 'LIKE', "%{$search}%")
                    ->orderBy('apellidos')
                    ->take(10) // Solo traemos los primeros 10 resultados para que sea rápido
                    ->get();

    return response()->json($tutores);
}
    /**
     * Buscar alumnos para autocompletado (AJAX)
     */
    public function buscar(Request $request)
    {
        $search = $request->input('q');
        
        if (empty($search)) {
            return response()->json([]);
        }

        $alumnos = Alumno::where('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellidos', 'LIKE', "%{$search}%")
                        ->orWhere('curp', 'LIKE', "%{$search}%")
                        ->orderBy('apellidos')
                        ->take(10)
                        ->get();

        return response()->json($alumnos);
    }
}
