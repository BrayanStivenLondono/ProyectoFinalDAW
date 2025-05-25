<?php

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\RijksmuseumController;
use App\Http\Controllers\SeguidorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WikiController;
use App\Http\Middleware\UsuarioAutenticadoMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Página principal
Route::get('/', [UsuarioController::class, 'index'])->name("inicio");

// API
//Route::get('/rijks-museum', [RijksmuseumController::class, 'verApi'])->name("rijks.index");
//Route::get('/rijks-museum/obras', [RijksmuseumController::class, 'verObras'])->name('rijks.obras');


// Carrusel
Route::get('/', [ObraController::class, 'carresulColecciones']);

// Colecciones
Route::get('/coleccion/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obras.coleccion');
Route::get('/colecciones', [ObraController::class, 'verTodasLasColecciones'])->name('obra.colecciones');
Route::get('/colecciones/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obra.verColeccion');

// Obras
Route::get('/obra/{slug}', [ObraController::class, 'verObra'])->name("verObra");
Route::get('/obras', [ObraController::class, 'verObras'])->name("verObras");
Route::get('/obras/buscar', [ObraController::class, 'buscarObra'])->name('buscarObra');


// Registro / Login
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.form');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

// Perfiles públicos
Route::get('/artista/{slug}', [UsuarioController::class, 'verPerfilArtista'])->name('artista.perfil');
Route::get('/artistas', [UsuarioController::class, 'artistas'])->name('artistas.index');

// Paneles y funciones privadas
Route::middleware(UsuarioAutenticadoMiddleware::class)->group(function () {
    Route::get('/usuario/p/{slug}', [UsuarioController::class, 'verPerfilPublico'])->name('usuario.perfil.publico');
    Route::get('/ajustes/perfil/{slug}', [UsuarioController::class, 'mostrarPerfil'])->name('usuario.perfil');
    Route::get('/ajustes/actualizar', [UsuarioController::class, 'mostrarEditorPerfil'])->name('mostrarEditorPerfil');
    Route::post('/ajustes/actualizar', [UsuarioController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::get('/ajustes/baja', [UsuarioController::class, 'mostrarPanelBaja'])->name('darseBaja');
    Route::delete('/ajustes/eliminar-cuenta', [UsuarioController::class, 'eliminarCuenta'])->name('eliminarCuenta');
    Route::get('/ajustes/actualizar-contrasena', [UsuarioController::class, 'formCambiarContrasena'])->name('formContrasena');
    Route::post('/ajustes/actualizar-contrasena', [UsuarioController::class, 'cambiarContrasena'])->name('cambiarContrasena');
    Route::get('/panel-artista', [UsuarioController::class, 'mostrarPanelArtista'])->name('panel.artista');
    Route::get('/obra/{id}/editar', [ObraController::class, 'editarObra'])->name('obra.editar');
    Route::put('/obra/{id}', [ObraController::class, 'actualizarObra'])->name('obra.actualizar');
    Route::get('/panel-artista/crear-obra', [ObraController::class, 'formCrearObra'])->name('formCrearObra');
    Route::post('/panel-artista/crear-obra', [ObraController::class, 'subirObra'])->name('subirObra');
    Route::delete('/panel-artista/eliminar-obra/{id}', [ObraController::class, 'eliminarObraArtista'])->name('artista.eliminarObra');


    //seguir
    Route::post('/seguir/{id}', [SeguidorController::class, 'seguir'])->name('seguir.usuario');
    Route::delete('/dejar-seguir/{id}', [SeguidorController::class, 'dejarDeSeguir'])->name('dejar.seguir.usuario');

    //favorito
    Route::post('/obra/{id}/favorito', [FavoritoController::class, 'agregar'])->name('favorito.agregar');
    Route::delete('/obra/{id}/favorito', [FavoritoController::class, 'eliminar'])->name('favorito.eliminar');
    Route::get('/ajustes/favoritos', [FavoritoController::class, 'obrasArtistasFavoritos'])->name('favoritos.ver');

    Route::delete('/seguir/{id}', [SeguidorController::class, 'dejarDeSeguir'])->name('seguir.toggle');


    //reporte
    Route::post('/comentarios/{id}/reportar', [ComentarioController::class, 'reportar'])->name('comentarios.reportar');
    Route::get('/panel-administracion/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/panel-administracion/reportes/{reporte}', [ReporteController::class, 'mostrar'])->name('reportes.mostrar');
    Route::post('/panel-administracion/reportes/{reporte}/aprobar', [ReporteController::class, 'aprobar'])->name('admin.reportes.aprobar');
    Route::post('/panel-administracion/reportes/{reporte}/rechazar', [ReporteController::class, 'rechazar'])->name('admin.reportes.rechazar');


});

//wiki
Route::get('/wiki/resumen', [WikiController::class, 'resumen'])->name('wiki.resumen');

//cookie
Route::post('/aceptar-cookies', function () {
    return response('')->cookie('cookies_aceptadas', true, 60 * 24 * 365); // 1 año
})->name('cookies.aceptar');


// Confirmar identidad
Route::get('/configuracion/confirmar-identidad', [UsuarioController::class, 'mostrarFormularioConfirmacion'])->name('confirmarContrasena');
Route::post('/configuracion/confirmar-identidad', [UsuarioController::class, 'confirmarIdentidad'])->name('confirmarContrasena.post');

// Confirmar contraseña adicional
Route::get('/ajustes', [UsuarioController::class, 'panelConfiguracion'])->name('configuracion');

// Cambiar idioma
Route::post('/set-language', [LanguageController::class, 'setLanguage'])->name('setLanguage');

// Likes
Route::post('/obras/{obra}/like', [LikeController::class, 'toggleLike'])->name('obras.like');

// Comentarios
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('crearComentario');

// Panel de administración
Route::get('/panel-administracion', [UsuarioController::class, 'mostrarPanelAdministracion'])->name('panel-admin');
Route::get('/admin', [UsuarioController::class, 'admin'])->name('admin');
Route::get('/panel-administracion/usuarios', [UsuarioController::class, 'index'])->name('panel_usuarios');
Route::get('/panel-administracion/obras', [ObraController::class, 'index'])->name('panel_obras');
Route::delete('/panel-administracion/usuarios/{id}', [UsuarioController::class, 'eliminarUsuario'])->name('admin.eliminarUsuario');
Route::delete('/panel-administracion/obra/{id}', [ObraController::class, 'eliminarObra'])->name('admin.eliminarObra');


//idioma
Route::post('/set-language', function (Request $request) {
    $locale = $request->input('locale');
    $availableLocales = ['es', 'en', 'fr'];

    if (in_array($locale, $availableLocales)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('setLanguage');
