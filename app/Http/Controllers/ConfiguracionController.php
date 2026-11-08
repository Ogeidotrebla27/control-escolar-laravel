<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Mostrar el formulario de configuración
     */
    public function index()
    {
        $config = Configuracion::getConfig();
        
        // Si no existe configuración, crear una por defecto
        if (!$config) {
            $config = Configuracion::create([
                'nombre_escuela' => 'Mi Escuela Primaria',
                'ciclo_actual' => date('Y') . '-' . (date('Y') + 1),
            ]);
        }

        return view('configuracion.index', compact('config'));
    }

    /**
     * Actualizar la configuración
     */
    public function update(Request $request)
    {
        $config = Configuracion::getConfig();

        $request->validate([
            'nombre_escuela' => 'required|string|max:255',
            'clave_centro_trabajo' => 'nullable|string|max:20',
            'zona_escolar' => 'nullable|string|max:20',
            'sector_educativo' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lema' => 'nullable|string|max:255',
            'director_nombre' => 'nullable|string|max:255',
            'director_cedula' => 'nullable|string|max:50',
            'supervisor_nombre' => 'nullable|string|max:255',
            'jefe_sector_nombre' => 'nullable|string|max:255',
            'crede_oficina' => 'nullable|string|max:255',
            'ciclo_inicio' => 'nullable|date',
            'ciclo_fin' => 'nullable|date|after:ciclo_inicio',
            'remitente_nombre' => 'nullable|string|max:255',
            'remitente_cargo' => 'nullable|string|max:255',
            'firma_director' => 'nullable|image|mimes:png|max:2048',
            'sello_escuela' => 'nullable|image|mimes:png|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'logo', 'firma_director', 'sello_escuela']);

        // Procesar logo
        if ($request->hasFile('logo')) {
            if ($config->logo && file_exists(public_path($config->logo))) {
                unlink(public_path($config->logo));
            }
            $file = $request->file('logo');
            $nombreArchivo = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $nombreArchivo);
            $data['logo'] = 'uploads/' . $nombreArchivo;
        }

        // Procesar firma del director
        if ($request->hasFile('firma_director')) {
            if ($config->firma_director && file_exists(public_path($config->firma_director))) {
                unlink(public_path($config->firma_director));
            }
            $file = $request->file('firma_director');
            $nombreArchivo = 'firma_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/firmas'), $nombreArchivo);
            $data['firma_director'] = 'uploads/firmas/' . $nombreArchivo;
        }

        // Procesar sello de la escuela
        if ($request->hasFile('sello_escuela')) {
            if ($config->sello_escuela && file_exists(public_path($config->sello_escuela))) {
                unlink(public_path($config->sello_escuela));
            }
            $file = $request->file('sello_escuela');
            $nombreArchivo = 'sello_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sellos'), $nombreArchivo);
            $data['sello_escuela'] = 'uploads/sellos/' . $nombreArchivo;
        }

        // Actualizar ciclo actual automáticamente
        if (isset($data['ciclo_inicio']) && isset($data['ciclo_fin'])) {
            $anioInicio = date('Y', strtotime($data['ciclo_inicio']));
            $anioFin = date('Y', strtotime($data['ciclo_fin']));
            $data['ciclo_actual'] = $anioInicio . '-' . $anioFin;
        }

        $config->update($data);

        return redirect()->route('configuracion.index')
                         ->with('success', 'Configuración actualizada correctamente.');
    }
}
