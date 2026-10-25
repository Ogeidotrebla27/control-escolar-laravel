<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de alumnos (CRUD completo)
Route::resource('alumnos', AlumnoController::class);
