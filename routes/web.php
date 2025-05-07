<?php

use App\Http\Controllers\HarvardController;
use App\Http\Controllers\ObraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


//APIS
Route::get('/apis', [App\Http\Controllers\HarvardController::class, 'index']);

//carrusel
Route::get('/', [ObraController::class, 'carresulColecciones']);

//coleccion
Route::get('/coleccion/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obras.coleccion');
Route::get('/colecciones', [ObraController::class, 'verTodasLasColecciones'])->name('obra.colecciones');
Route::get('/colecciones/{tipo}', [ObraController::class, 'obtenerObrasPorTipo'])->name('obra.verColeccion');





