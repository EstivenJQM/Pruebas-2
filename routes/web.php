<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\TipoActividadController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ServicioUsuarioController;

Route::get('/', fn() => redirect()->route('servicios.index'));

Route::resource('areas',           AreaController::class);
Route::resource('componentes',     ComponenteController::class);
Route::resource('lineas',          LineaController::class);
Route::resource('tipos_actividad', TipoActividadController::class);
Route::resource('sedes',           SedeController::class);
Route::resource('usuarios',        UsuarioController::class);
Route::resource('servicios',       ServicioController::class);

// Gestión de participantes
Route::get ('servicios/{servicio}/participantes',        [ServicioController::class,       'participantes'])->name('servicios.participantes');
Route::post('servicios/{servicio}/participantes/buscar', [ServicioUsuarioController::class, 'buscar'])->name('servicios.buscar');
Route::post('servicios/{servicio}/participantes/agregar',[ServicioUsuarioController::class, 'agregar'])->name('servicios.agregar');
Route::delete('servicios/{servicio}/participantes/{rolUsuario}', [ServicioUsuarioController::class, 'quitar'])->name('servicios.quitar');