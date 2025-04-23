<?php

use App\Http\Controllers\HarvardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


//APIS
Route::get('/apis', [App\Http\Controllers\HarvardController::class, 'index']);

//
