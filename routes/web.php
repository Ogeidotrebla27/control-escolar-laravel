<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ListadoController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de configuración (solo Administrador)
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
    Route::put('/configuracion', [ConfiguracionController::class, 'update'])->name('configuracion.update');
});

// Ruta de dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// RUTAS DE ALUMNOS
// ==========================================
// 🔥 Las rutas específicas SIEMPRE van antes del resource
Route::get('/alumnos/test', function () {
    return view('alumnos.test');
})->middleware('auth');

Route::get('/alumnos/buscar', [AlumnoController::class, 'buscar'])->name('alumnos.buscar')->middleware('auth');
Route::get('/alumnos/buscar-tutores', [AlumnoController::class, 'buscarTutores'])->name('alumnos.buscarTutores')->middleware('auth');
Route::get('/alumnos/{id}/print', [AlumnoController::class, 'print'])->name('alumnos.print')->middleware('auth');

// Ahora sí, el resource
Route::resource('alumnos', AlumnoController::class)->middleware('auth');

// ==========================================
// RUTAS DE TUTORES
// ==========================================
Route::resource('tutores', TutorController::class)->middleware('auth');

// ==========================================
// RUTAS DE BITÁCORA
// ==========================================
Route::resource('bitacoras', BitacoraController::class)->middleware('auth');

// ==========================================
// RUTAS DE LISTADOS
// ==========================================
Route::get('/listados', [ListadoController::class, 'index'])->name('listados.index')->middleware('auth');
Route::get('/listados/pdf', [ListadoController::class, 'pdf'])->name('listados.pdf')->middleware('auth');
Route::get('/listados/excel', [ListadoController::class, 'excel'])->name('listados.excel')->middleware('auth');
Route::get('/listados/print', [ListadoController::class, 'print'])->name('listados.print')->middleware('auth');
Route::get('/listados/tutores', [ListadoController::class, 'tutoresIndex'])->name('listados.tutores.index')->middleware('auth');
Route::get('/listados/tutores/print', [ListadoController::class, 'tutoresPrint'])->name('listados.tutores.print')->middleware('auth');
Route::get('/listados/tutores/general', [ListadoController::class, 'tutoresGeneral'])->name('listados.tutores.general')->middleware('auth');

// ==========================================
// RUTAS DE AUTENTICACIÓN (BREEZE)
// ==========================================
require __DIR__.'/auth.php';