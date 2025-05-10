<?php

use App\Http\Controllers\ObraController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/',[UsuarioController::class, 'index'])->name("inicio");



//APIS
Route::get('/apis', [App\Http\Controllers\HarvardController::class, 'index']);

//carrusel
Route::get('/', [ObraController::class, 'carresulColecciones']);

//coleccion
Route::get('/coleccion/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obras.coleccion');
Route::get('/colecciones', [ObraController::class, 'verTodasLasColecciones'])->name('obra.colecciones');
Route::get('/colecciones/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obra.verColeccion');


//Obras
Route::get('/obra/{slug}', [ObraController::class, 'verObra']);


//registro | login
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.form');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');


//Perfil
Route::get('/perfil', [UsuarioController::class, 'mostrarPerfil'])->middleware('auth')->name('perfil');
Route::get('/perfil/actualizar', [UsuarioController::class, 'mostrarEditorPerfil'])->middleware('auth')->name('mostrarEditorPerfil');
Route::post('/perfil/actualizar', [UsuarioController::class, 'actualizarPerfil'])->middleware('auth')->name('perfil.actualizar');

Route::get('/configuracion', [UsuarioController::class, 'mostrarConfiguracionUsuario'])->middleware('auth')->name('configuracion');

//mostrarEditorPerfil
