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
Route::get('/', [ObraController::class, 'obtenerObrasCarrusel'])->name('carrusel.imagenes');

