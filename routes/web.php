<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/',[UsuarioController::class, 'index'])->name("inicio");



//APIS
Route::get('/harvard-museum', [App\Http\Controllers\HarvardController::class, 'index'])->name("harvard");


//carrusel
Route::get('/', [ObraController::class, 'carresulColecciones']);

//coleccion
Route::get('/coleccion/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obras.coleccion');
Route::get('/colecciones', [ObraController::class, 'verTodasLasColecciones'])->name('obra.colecciones');
Route::get('/colecciones/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obra.verColeccion');


//Obras
Route::get('/obra/{slug}', [ObraController::class, 'verObra'])->name("verObra");


//registro | login
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.form');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');


//Perfil
Route::get('/usuario/publico/{slug}', [UsuarioController::class, 'verPerfilPublico'])->name('usuario.perfil.publico');
Route::get('/usuario/{slug}', [UsuarioController::class, 'mostrarPerfil'])->name('usuario.perfil');
Route::get('/perfil/actualizar', [UsuarioController::class, 'mostrarEditorPerfil'])->middleware('auth')->name('mostrarEditorPerfil');
Route::post('/perfil/actualizar', [UsuarioController::class, 'actualizarPerfil'])->middleware('auth')->name('perfil.actualizar');

Route::get('/configuracion', [UsuarioController::class, 'mostrarConfiguracionUsuario'])->middleware('auth')->name('configuracion');

//mostrarEditorPerfil


//artista
Route::get('/artista/{slug}', [UsuarioController::class, 'verPerfilArtista'])->name('artista.perfil');
Route::get('/artistas', [UsuarioController::class, 'artistas'])->name('artistas.index');
Route::get('/panel-artista', [UsuarioController::class, 'mostrarPanelArtista'])
    ->middleware('auth')
    ->name('panel.artista');



//cambio de idioma
Route::post('/set-language', [LanguageController::class, 'setLanguage'])->name('setLanguage');

//likes
Route::post('/obras/{obra}/like', [LikeController::class, 'toggleLike'])->name('obras.like');

//comentarios
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('crearComentario');


//admin
Route::get('/panel-administracion', [UsuarioController::class, 'mostrarPanelAdministracion'])->name('panel-admin');
Route::get('/admin', [UsuarioController::class, 'admin'])->name('admin');
Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('panel_usuarios');
Route::get('/admin/obras', [ObraController::class, 'index'])->name('panel_obras');
Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'eliminarUsuario'])->name('admin.eliminarUsuario');
Route::delete('/admin/obra/{id}', [ObraController::class, 'eliminarObra'])->name('admin.eliminarObra');

//artista
Route::get('/obra/{id}/editar', [ObraController::class, 'editarObra'])->name('obra.editar');
Route::put('/obra/{id}', [ObraController::class, 'actualizarObra'])->name('obra.actualizar');




