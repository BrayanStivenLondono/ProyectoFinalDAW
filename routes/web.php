<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SeguidorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WikiController;
use App\Http\Middleware\EsAdministrador;
use App\Http\Middleware\UsuarioAutenticadoMiddleware;
use Illuminate\Support\Facades\Route;

// Página principal y carrusel
Route::get('/', [ObraController::class, 'carresulColecciones'])->name("inicio");

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
Route::get('/usuario/p/{slug}', [UsuarioController::class, 'verPerfilPublico'])->name('usuario.perfil.publico');


// Paneles y funciones privadas (usuarios autenticados)
Route::middleware(UsuarioAutenticadoMiddleware::class)->group(function () {

    // Perfil y configuración
    Route::get('/ajustes/perfil/{slug}', [UsuarioController::class, 'mostrarPerfil'])->name('usuario.perfil');
    Route::get('/ajustes/actualizar', [UsuarioController::class, 'mostrarEditorPerfil'])->name('mostrarEditorPerfil');
    Route::post('/ajustes/actualizar', [UsuarioController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::get('/ajustes/baja', [UsuarioController::class, 'mostrarPanelBaja'])->name('darseBaja');
    Route::delete('/ajustes/eliminar-cuenta', [UsuarioController::class, 'eliminarCuenta'])->name('eliminarCuenta');
    Route::get('/ajustes/actualizar-contrasena', [UsuarioController::class, 'formCambiarContrasena'])->name('formContrasena');
    Route::post('/ajustes/actualizar-contrasena', [UsuarioController::class, 'cambiarContrasena'])->name('cambiarContrasena');
    Route::get('/ajustes/favoritos', [FavoritoController::class, 'obrasArtistasFavoritos'])->name('favoritos.ver');

    // Panel de artista
    Route::get('/panel-artista', [UsuarioController::class, 'mostrarPanelArtista'])->name('panel.artista');
    Route::get('/panel-artista/crear-obra', [ObraController::class, 'formCrearObra'])->name('formCrearObra');
    Route::post('/panel-artista/crear-obra', [ObraController::class, 'subirObra'])->name('subirObra');
    Route::get('/obra/{id}/editar', [ObraController::class, 'editarObra'])->name('obra.editar');
    Route::put('/obra/{id}', [ObraController::class, 'actualizarObra'])->name('obra.actualizar');
    Route::delete('/panel-artista/eliminar-obra/{id}', [ObraController::class, 'eliminarObraArtista'])->name('artista.eliminarObra');

    // Seguir / dejar de seguir
    Route::post('/seguir/{id}', [SeguidorController::class, 'seguir'])->name('seguir.usuario');
    Route::delete('/dejar-seguir/{id}', [SeguidorController::class, 'dejarDeSeguir'])->name('dejar.seguir.usuario');

    // Favoritos
    Route::post('/obra/{id}/favorito', [FavoritoController::class, 'agregar'])->name('favorito.agregar');
    Route::delete('/obra/{id}/favorito', [FavoritoController::class, 'eliminar'])->name('favorito.eliminar');

    // Comentarios y reportes
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('crearComentario');
    Route::post('/comentarios/{id}/reportar', [ComentarioController::class, 'reportar'])->name('comentarios.reportar');
});

// Rutas exclusivas de administradores
Route::middleware([UsuarioAutenticadoMiddleware::class, EsAdministrador::class])->group(function () {

    // Panel de administración
    Route::get('/panel-administracion', [UsuarioController::class, 'mostrarPanelAdministracion'])->name('panel-admin');
    Route::get('/admin', [UsuarioController::class, 'admin'])->name('admin');
    Route::get('/panel-administracion/usuarios', [UsuarioController::class, 'index'])->name('panel_usuarios');
    Route::get('/panel-administracion/obras', [ObraController::class, 'index'])->name('panel_obras');

    // Gestión
    Route::delete('/panel-administracion/usuarios/{id}', [UsuarioController::class, 'eliminarUsuario'])->name('admin.eliminarUsuario');
    Route::delete('/panel-administracion/obra/{id}', [ObraController::class, 'eliminarObra'])->name('admin.eliminarObra');
    Route::post('/panel-administracion/hacer-admin/{id}', [UsuarioController::class, 'hacerAdmin'])->name('admin.cambiarRol');

    // Reportes
    Route::get('/panel-administracion/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/panel-administracion/reportes/{reporte}', [ReporteController::class, 'mostrar'])->name('reportes.mostrar');
    Route::post('/panel-administracion/reportes/{reporte}/aprobar', [ReporteController::class, 'aprobar'])->name('admin.reportes.aprobar');
    Route::post('/panel-administracion/reportes/{reporte}/rechazar', [ReporteController::class, 'rechazar'])->name('admin.reportes.rechazar');
});

// Otros
Route::get('/wiki/resumen', [WikiController::class, 'resumen'])->name('wiki.resumen');

// Footer (estáticas)
Route::view('/nuestra-historia', 'layouts.nuestra_historia')->name('nuestraHistoria');
Route::view('/contacto', 'layouts.contacto')->name('contacto');
Route::view('/equipo', 'layouts.equipo')->name('equipo');

// Cookies
Route::post('/aceptar-cookies', function () {
    return response('')->cookie('cookies_aceptadas', true, 60 * 24 * 365);
})->name('cookies.aceptar');

// Confirmación de identidad
Route::get('/configuracion/confirmar-identidad', [UsuarioController::class, 'mostrarFormularioConfirmacion'])->name('confirmarContrasena');
Route::post('/configuracion/confirmar-identidad', [UsuarioController::class, 'confirmarIdentidad'])->name('confirmarContrasena.post');

// Configuración
Route::get('/ajustes', [UsuarioController::class, 'panelConfiguracion'])->name('configuracion');

// Likes
Route::post('/obras/{obra}/like', [LikeController::class, 'toggleLike'])->name('obras.like');
