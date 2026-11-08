<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
   public function index(Request $request)
{
    // 🔥 Agregamos with('alumnos') para traer a los hijos de una vez
    $query = Tutor::with('alumnos');

    // Filtro de búsqueda por nombre o CURP
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('apellidos', 'LIKE', "%{$search}%")
              ->orWhere('curp', 'LIKE', "%{$search}%");
        });
    }

    $tutores = $query->orderBy('apellidos')->paginate(15);
    return view('tutores.index', compact('tutores'));
}

    public function create()
    {
        return view('tutores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:tutores,curp',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'lugar_trabajo' => 'nullable|string|max:255',
        ]);

        // Capitalizar datos antes de guardar
        $data = $request->all();
        $data['nombre'] = ucwords(strtolower($data['nombre']));
        $data['apellidos'] = ucwords(strtolower($data['apellidos']));
        if (!empty($data['ocupacion'])) $data['ocupacion'] = ucwords(strtolower($data['ocupacion']));
        if (!empty($data['lugar_trabajo'])) $data['lugar_trabajo'] = ucwords(strtolower($data['lugar_trabajo']));
        if (!empty($data['direccion'])) $data['direccion'] = ucwords(strtolower($data['direccion']));
        
        $data['user_id'] = auth()->id();

        Tutor::create($data);

        return redirect()->route('tutores.index')
                         ->with('success', 'Tutor creado correctamente.');
    }

    public function show($id)
    {
        $tutor = Tutor::with('alumnos')->findOrFail($id);
        return view('tutores.show', compact('tutor'));
    }

    public function edit($id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.edit', compact('tutor'));
    }

    public function update(Request $request, $id)
    {
        $tutor = Tutor::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:tutores,curp,' . $id,
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'lugar_trabajo' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        
        // Capitalizar datos antes de guardar
        $data['nombre'] = ucwords(strtolower($data['nombre']));
        $data['apellidos'] = ucwords(strtolower($data['apellidos']));
        if (!empty($data['ocupacion'])) $data['ocupacion'] = ucwords(strtolower($data['ocupacion']));
        if (!empty($data['lugar_trabajo'])) $data['lugar_trabajo'] = ucwords(strtolower($data['lugar_trabajo']));
        if (!empty($data['direccion'])) $data['direccion'] = ucwords(strtolower($data['direccion']));

        $tutor->update($data);

        return redirect()->route('tutores.index')
                         ->with('success', 'Tutor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();

        return redirect()->route('tutores.index')
                         ->with('success', 'Tutor eliminado correctamente.');
    }
}