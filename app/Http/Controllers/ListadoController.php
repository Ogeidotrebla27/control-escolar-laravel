<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Configuracion;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ListadoAlumnosExport;

class ListadoController extends Controller
{
    /**
     * Mostrar listado de alumnos por grupo
     */
    public function index(Request $request)
    {
        $config = Configuracion::first();
        $grupos = Alumno::select('grado', 'grupo')
                        ->distinct()
                        ->orderBy('grado')
                        ->orderBy('grupo')
                        ->get();

        $alumnos = collect();
        $gradoSeleccionado = $request->grado;
        $grupoSeleccionado = $request->grupo;

        if ($gradoSeleccionado && $grupoSeleccionado) {
            $alumnos = Alumno::where('grado', $gradoSeleccionado)
                            ->where('grupo', $grupoSeleccionado)
                            ->orderBy('apellidos')
                            ->get();
        }

        return view('listados.index', compact('grupos', 'alumnos', 'gradoSeleccionado', 'grupoSeleccionado', 'config'));
    }

    /**
     * Mostrar listado para imprimir (HTML)
     */
    public function print(Request $request)
    {
        $config = Configuracion::first();
        $grado = $request->grado;
        $grupo = $request->grupo;

        $alumnos = Alumno::where('grado', $grado)
                        ->where('grupo', $grupo)
                        ->orderBy('apellidos')
                        ->get();

        return view('listados.print', compact('alumnos', 'config', 'grado', 'grupo'));
    }

    /**
     * Mostrar pantalla para listados de tutores
     */
    public function tutoresIndex(Request $request)
    {
        $grupos = Alumno::select('grado', 'grupo')
                        ->distinct()
                        ->orderBy('grado')
                        ->orderBy('grupo')
                        ->get();

        return view('listados.tutores_index', compact('grupos'));
    }

    /**
     * Generar lista de tutores de un grupo específico
     */
    public function tutoresPrint(Request $request)
    {
        $config = Configuracion::first();
        $grado = $request->grado;
        $grupo = $request->grupo;
        $filtro = $request->filtro; // 'todos' o 'regulares'
        $tipo_lista = $request->tipo_lista; // 'todos' o 'responsables'

        $queryAlumnos = Alumno::where('grado', $grado)->where('grupo', $grupo);
        if ($filtro == 'regulares') {
            $queryAlumnos->where('estatus', 'Regular');
        }
        $alumnos = $queryAlumnos->get();

        $tutores = Tutor::whereHas('alumnos', function($q) use ($alumnos, $tipo_lista) {
            $q->whereIn('alumnos.id', $alumnos->pluck('id'));
            if ($tipo_lista == 'responsables') {
                $q->where('alumno_tutor.es_responsable', 1);
            }
        })->orderBy('apellidos')->get();

        return view('listados.tutores_print', compact('tutores', 'config', 'grado', 'grupo', 'filtro', 'alumnos', 'tipo_lista'));
    }

    /**
     * Generar lista GENERAL de tutores (sin duplicados)
     */
    public function tutoresGeneral(Request $request)
    {
        $config = Configuracion::first();
        $filtro = $request->filtro; 
        $tipo_lista = $request->tipo_lista; // 'todos' o 'responsables'

        $queryAlumnos = Alumno::query();
        if ($filtro == 'regulares') {
            $queryAlumnos->where('estatus', 'Regular');
        }
        $alumnos = $queryAlumnos->get();

        $tutores = Tutor::whereHas('alumnos', function($q) use ($alumnos, $tipo_lista) {
            $q->whereIn('alumnos.id', $alumnos->pluck('id'));
            if ($tipo_lista == 'responsables') {
                $q->where('alumno_tutor.es_responsable', 1);
            }
        })->whereDoesntHave('alumnos', function($q) use ($alumnos) {
            $q->where('grado', '>', $alumnos->max('grado') ?? 0);
        })->orderBy('apellidos')->get();

        return view('listados.tutores_general', compact('tutores', 'config', 'filtro', 'tipo_lista'));
    }
}